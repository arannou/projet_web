<?php

require_once 'Model/Service/interfaceBorrowService.php';
require_once 'Model/DAO/implementationBorrowingsDAO_Session.php';
require_once 'Model/DAO/implementationUserDAO_Session.php';
require_once 'Model/DAO/implementationKeychainDAO_Session.php';

class implementationBorrowService implements interfaceBorrowService
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
      $factory = getDAOFactory();

      $this->_userDAO       = $factory->getUserDAO();
      $this->_keychainDAO   = $factory->getKeychainDAO();
      $this->_borrowingsDAO = $factory->getBorrowingsDAO();
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
      self::$_instance = new implementationBorrowService();

    }

    return self::$_instance;
  }


  //On emprunte toujours un trousseau
  public function borrowKeychain($userId,$keychainId,DateTime $dueDate)
  {
    $tDate = new DateTime;
    $tDate->setTimestamp(time());
    //Ajout d'un emprunt
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

  //On récupère les emprunts à l'aide de leur ID
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

  //On récupère les emprunts à l'aide de la clé Enssat d'un utilisateur
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

  //On récupère les emprunts à l'aide de l'identifiant d'un trousseau
  //Si on trouve un trousseau, on retourne le trousseau, sinon, on retourne null.
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

  //On récupère la liste des emprunts en retard
  public function getLateBorrowing(){
    $borrowings = $this->_borrowingsDAO->getBorrowings();

    $late = [];
    $now = new DateTime();
    //Pour chaque emprunts, à chaque fois que la date de prétendu rendu est supérieur à la date du jour, on ajoute le trousseau à la liste des trousseaux en retard
    foreach ($borrowings as $key => $borrowing) {
      if($borrowing['dueDate']->getTimestamp() - $now->getTimestamp() <= 0 && $borrowing['returnDate'] == null && $borrowing['lostDate'] == null){
        array_push($late, $borrowing);
      }
    }
    return $late;
  }

  //On récupère la liste des emprunts actuels
  public function getCurrentBorrowings(){
    $borrowings = $this->_borrowingsDAO->getBorrowings();
    $current = [];

    foreach ($borrowings as $key => $borrowing) {
      //On récupère tous les trousseaux qui ne sont ni rendu ni perdu
      if($borrowing['lostDate'] == null && $borrowing['returnDate'] == null){
        $current[$key] = $borrowing;
        $current[$key]['status'] = $this->getBorrowingStatus($borrowing['borrowingId']);
      }
    }
    return $current;
  }

  //On récupère la liste des emprunts perdus
  public function getLostBorrowing(){
    $borrowings = $this->_borrowingsDAO->getBorrowings();
    $lost = [];
    //On récupère la liste des emprunts dont le status est "Lost" (Perdu)
    foreach ($borrowings as $key => $borrowing) {
      if($this->getBorrowingStatus($borrowing['borrowingId']) == "Lost"){
        $lost[$key] = $borrowing;
        $lost[$key]['status'] = "Lost";
      }
    }

    return $lost;
  }

  //Ajout d'un status à l'emprunt
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
        $this->_borrowings[$borrowingId-1]['returnDate'] = $tDate;
        $_SESSION["borrowings"][$borrowingId-1]['returnDate'] = $tDate;
        break;
        case "Lost":
        $this->_borrowings[$borrowingId-1]['lostDate'] = $tDate;
        $_SESSION["borrowings"][$borrowingId-1]['lostDate'] = $tDate;
        var_dump($_SESSION["borrowings"][$borrowingId-1]);
        break;
        default :
        throw new RuntimeException('borrowing does not exists.');
      }
    }
  }

  //Récupération du status d'un emprunt
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

  //Annulation d'un emprunt
  private function _cancelBorrowing($borrowingId,$type,$comment)
  {
    $status = $this->getBorrowingStatus($borrowingId);
    if(strcmp($status,"DoesNotExists")!==0  && strcmp($status,"Returned")!==0 )
    {
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

  //On indique que le trousseau est rendu à l'aide de l'identifiant de l'emprunt
  public function returnKeychain($borrowingId,$comment)
  {
    $this->_cancelBorrowing($borrowingId,"return",$comment);
  }

  //On indique que le trousseau est perdu à l'aide de l'identifiant de l'emprunt
  public function lostKeychain($borrowingId,$comment)
  {
    $this->_cancelBorrowing($borrowingId,"lost",$comment);
  }

  //On modifie la date de rendu d'un emprunt
  public function setNewDueDate($borrowingId, DateTime $dueDate) {
    $borrowing = $this->getBorrowingById($borrowingId);
    $_SESSION["borrowings"][$borrowingId-1]['dueDate'] = $dueDate;
  }

  //On retourne un tableau d'emprunt avec leur statut
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
