<?php

require_once 'Model/Service/interfaceBorrowService.php';
require_once 'Model/DAO/implementationBorrowingsDAO_Session.php';
require_once 'Model/DAO/implementationUserDAO_Dummy.php';

class implementationBorrowService_Dummy implements interfaceBorrowService
{

  public static $borrowingStatus = array(
    "DoesNotExists"=>"n\'existe pas",
    "Borrowed"=>"en cours",
    "Late"=>"en retard",
    "Returned"=>"rendu",
    "Lost"=>"perdu",
  );

  /**
   * @var Singleton
   * @access private
   * @static
   */
   private static $_instance = null;

   private $_borrowings = array(); // userId, keychainId, dateBorrowed, dateReturned, dateLost, comment
   private $_userDAO;
   private $_keychainDAO;
   private $_borrowingsDAO;

   /**
   * Constructeur de la classe
   *
   * @param void
   * @return void
   */
   private function __construct()
   {
     $this->_userDAO       = implementationUserDAO_Dummy::getInstance();
     $this->_keychainDAO   = implementationKeychainDAO_Dummy::getInstance();
     $this->_borrowingsDAO = implementationBorrowingsDAO_Session::getInstance();
   }

      /**
       * Méthode qui crée l'unique instance de la classe
       * si elle n'existe pas encore puis la retourne.
       *
       * @param void
       * @return Singleton
       */
      public static function getInstance() {

        if(is_null(self::$_instance)) {
          self::$_instance = new implementationBorrowService_Dummy();
      }

        return self::$_instance;
      }


    //on emprunte toujours un trousseau
    public function borrowKeychain($userId,$keychainId,DateTime $dueDate)
    {
      $tDate = new DateTime;
      $tDate->setTimestamp(time());

      //@todo : Faire les verifications de sécurité avant de valider l'emprunt
      $this->_borrowingsDAO->addBorrow([
        'borrowingId'=>count($this->_borrowingsDAO->getBorrowings())+1,
        'userEnssatPrimaryKey'=>$userId,
        'keychainId'=>$keychainId,
        'borrowDate'=>$tDate,
        'dueDate'=>$dueDate,
        'returnDate'=>null,
        'lostDate'=>null,
        'comment'=>""
      ]);
    }

    public function getBorrowingById($borrowingId)
    {
      $borrowing=null;
      $borrowings = $this->_borrowingsDAO->getBorrowings();
      if(count($borrowings)+1 > $borrowingId)
      {
        $borrowing = $borrowings[$borrowingId-1];

      }
      return $borrowing;
    }

    public function getBorrowingByEnssatPrimaryKey($userEnssatPrimaryKey) {
      $borrowingArray = null;
      $borrowings = $this->_borrowingsDAO->getBorrowings();
      foreach ($borrowings as $key => $borrowing) {
        if ($borrowing['userEnssatPrimaryKey'] == $userEnssatPrimaryKey) {
          $borrowingArray[] = $borrowing;
        }
      }
      return $borrowingArray;
    }

    public function getBorrowingByKeychainId($keychainId){
        $borrowing  = null;
        $borrowings = $this->_borrowingsDAO->getBorrowings();
        foreach ($borrowings as $key => $borrowing) {
            if($borrowing['keychainId']  == $keychainId)
            {
                return $borrowing;
            }
        }

        return null;
    }

    public function getLateBorrowing(){
        $borrowings = $this->_borrowingsDAO->getBorrowings();

        $late = [];
        $now = new DateTime();

        foreach ($borrowings as $key => $borrowing) {
            if($borrowing['dueDate']->getTimestamp() - $now->getTimestamp() <= 0 && $borrowing['returnDate'] == null && $borrowing['lostDate'] == null){
                array_push($late, $borrowing);
            }
        }

        return $late;
    }

    public function getCurrentBorrowings(){
        $borrowings = $this->_borrowingsDAO->getBorrowings();
        $current = [];

        foreach ($borrowings as $key => $borrowing) {
            if($borrowing['lostDate'] == null && $borrowing['returnDate'] == null){
                $current[$key] = $borrowing;
                $current[$key]['status'] = $this->getBorrowingStatus($borrowing['borrowingId']);
            }
        }

        return $current;
    }

	public function getLostBorrowing(){
        $borrowings = $this->_borrowingsDAO->getBorrowings();
        $lost = [];

        foreach ($borrowings as $key => $borrowing) {
            if($this->getBorrowingStatus($borrowing['borrowingId']) == "Lost"){
                $lost[$key] = $borrowing;
                $lost[$key]['status'] = "Lost";
            }
        }

        return $lost;
    }

    public function setBorrowingStatus($borrowingId,$status)
    {

      $oStatus = $this->getBorrowingStatus($borrowingId);
      $tDate = new DateTime;
      $tDate->setTimestamp(time());
      if(strcmp($oStatus,"DoesNotExists")!==0)
      {
        switch($status)
        {
          case "Returned":
            $this->_borrowings[$borrowingId-1]['returnDate'] = $tDate; //@todo : Mettre a jour $_SESSION
            $_SESSION["borrowings"][$borrowingId-1]['returnDate'] = $tDate; //@todo : Mettre a jour $_SESSION
          break;
          case "Lost":
            $this->_borrowings[$borrowingId-1]['lostDate'] = $tDate; //@todo : Mettre a jour $_SESSION
            $_SESSION["borrowings"][$borrowingId-1]['lostDate'] = $tDate; //@todo : Mettre a jour $_SESSION
				var_dump($_SESSION["borrowings"][$borrowingId-1]);
          break;
        default :
           throw new RuntimeException('borrowing does not exists.');
        }

      }
    }

    public function getBorrowingStatus($borrowingId)
    {
      $status = "DoesNotExists";
      if(!is_null($borrowing=$this->getBorrowingById($borrowingId)))
      {
        if(!is_null($borrowing['returnDate']))
        {
          $status = "Returned";
        }
        else
        {
          if(!is_null($borrowing['lostDate']))
          {
            $status = "Lost";
          }
          else
          {
			  $tDate = new DateTime;
			  $tDate->setTimestamp(time());

			  $firstDateTimeStamp = $borrowing['dueDate']->format("U");
    			$secondDateTimeStamp = $tDate->format("U");
    			$rv = round ((($firstDateTimeStamp - $secondDateTimeStamp))/86400);

			  
			  if ($rv<0) {
				  $status = "Late";
			  } else {
				  $status = "Borrowed";
			  }
          }
        }
      }
      return $status;
    }

    private function _cancelBorrowing($borrowingId,$type,$comment)
    {
        $status = $this->getBorrowingStatus($borrowingId);
        #echo "status of borrowingId ".$borrowingId." : ".$status."\n";
        if(strcmp($status,"DoesNotExists")!==0  && strcmp($status,"Returned")!==0 )
        {
            #echo "\tprocessing\n";
          switch($type)
          {
            case "return" :
              $this->setBorrowingStatus($borrowingId,"Returned");
              break;
            case "lost" :
              $this->setBorrowingStatus($borrowingId,"Lost");
              break;
            default :
               throw new RuntimeException('borrowing does not exists.');
          }
          $this->_borrowings[$borrowingId-1]['comment'] = $comment;
          $_SESSION["borrowings"][$borrowingId-1]['comment'] = $comment;

        }
    }

    public function returnKeychain($borrowingId,$comment)
    {
      $this->_cancelBorrowing($borrowingId,"return",$comment);
    }

    public function lostKeychain($borrowingId,$comment)
    {
      $this->_cancelBorrowing($borrowingId,"lost",$comment);

    }


    //@todo : Remplacer l'utilisation de cette fonction par celle en DAO
    public function getBorrowingsWithStatus()
    {
      $borrowings = $this->_borrowingsDAO->getBorrowings();
      foreach ($borrowings as $key => $borrowing) {
          $borrowings[$key]['status'] = $this->getBorrowingStatus($borrowing['borrowingId']);
      }
      return $borrowings;
    }

}

?>
