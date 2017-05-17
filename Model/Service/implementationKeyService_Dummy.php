<?php


require_once 'Model/DAO/implementationKeyDAO_Dummy';

class implementationKeyService_Dummy
{

  /**
   * @var Singleton
   * @access private
   * @static
   */
   private static $_instance = null;

   private $_keyDAO;


   /**
   * Constructeur de la classe
   *
   * @param void
   * @return void
   */
   private function __construct()
   {
     $this->_keyDAO  = implementationUserDAO_Dummy::getInstance();
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
          self::$_instance = new implementationKeyervice_Dummy();
      }

        return self::$_instance;
      }

/*
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

    //@todo : Remplacer l'utilisation de cette fonction par celle présente en DAO
    public function getBorrowingById($borrowingId)
    {
      $borrowing=null;
      $borrowings = $this->getBorrowings();
      if(count($borrowings)+1 > $borrowingId)
      {
        $borrowing = $borrowings[$borrowingId-1];

      }
      return $borrowing;
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
          break;
          case "Lost":
            $this->_borrowings[$borrowingId-1]['lostDate'] = $tDate; //@todo : Mettre a jour $_SESSION
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
            $status = "Borrowed";
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
          $this->_borrowings[$borrowingId-1]['comment'] .= $comment;
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
    public function getBorrowings()
    {
      return $this->_borrowingsDAO->getBorrowings();
    }

}*/

?>