<?php
require_once 'Model/DAO/implementationUserDAO_Session.php';

class implementationUserService
{

  /**
  * @var Singleton
  * @access private
  * @static
  */
  private static $_instance = null;

  private $_userDAO;


  /**
  * Constructeur de la classe
  *
  * @param void
  * @return void
  */
  private function __construct()
  {
    $this->_userDAO  = implementationUserDAO_Session::getInstance();
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
      self::$_instance = new implementationUserService();
    }

    return self::$_instance;
  }

  //Création d'un utilisateur à l'aide d'un CSV
  public function createUserFromCSV($username, $enssatPrimaryKey, $Ur1Identifier, $name, $surname, $phone, $status, $email) {
    if(!$this->checkUserByEnssatPrimaryKey($enssatPrimaryKey)) {
      $user = new UserVO();
      $user->setUr1identifier((int) $Ur1Identifier);
      $user->setEnssatPrimaryKey((int) $enssatPrimaryKey);
      $user->setUsername($username);
      $user->setName($name);
      $user->setSurname($surname);
      $user->setPhone($phone);
      $user->setStatus($status);
      $user->setEmail($email);
      $this->_userDAO->addUser($user);
    }
  }

  //Vérification de l'utilisateur à l'aide d'un identifiant Enssat
  public function checkUserByEnssatPrimaryKey($enssatPrimaryKey) {
    if ($this->_userDAO->getUserByEnssatPrimaryKey($enssatPrimaryKey) != null) {
      return true;
    }
    else {
      return false;
    }
  }
}
?>
