<?php
require_once 'Model/DAO/interfaceFournisseurDAO.php';
require_once 'Model/VO/ProviderVO.php';

class implementationFournisseurDAO_MYSQL extends ImplementationDAO_MYSQL implements interfaceFournisseurDAO
{

  private $_providers = array();
  private $_tableName = "provider";

  /**
  * @var Singleton
  * @access private
  * @static
  */
  private static $_instance = null;


  /**
  * Constructeur de la classe
  *
  * @param void
  * @return void
  */
  private function __construct() {
    parent::initDb();
  }

  public function populate() {
    if (file_exists(dirname(__FILE__).'/providers.xml')) {
      $providers = simplexml_load_file(dirname(__FILE__).'/providers.xml');
      foreach($providers->children() as $xmlProvider)
      {
        $provider = new ProviderVO;

        $provider->setId((float) $xmlProvider->id);
        $provider->setUsername((String) $xmlProvider->username);
        $provider->setName((String) $xmlProvider->name);
        $provider->setSurname((String) $xmlProvider->surname);
        $provider->setPhone((String) $xmlProvider->phone);
        $provider->setOffice((String) $xmlProvider->office);
        $provider->setEmail((String) $xmlProvider->email);

        $this->addProvider($provider);
      }
    } else {
      exit('Echec lors de l\'ouverture du fichier providers.xml.');
    }
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
      self::$_instance = new implementationFournisseurDAO_MYSQL();
    }

    return self::$_instance;
  }


  public function getProviders(){
    $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName");
    $stmt->execute();

    $providers = [];
    $provider = new ProviderVO;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $provider->setId($row["id"]);
      $provider->setUsername($row["username"]);
      $provider->setName($row["name"]);
      $provider->setSurname($row["surname"]);
      $provider->setPhone($row["phone"]);
      $provider->setOffice($row["office"]);
      $provider->setEmail($row["email"]);

      array_push($providers, $provider);
    }

    return $providers;
  }

  public function getProviderById($id){
    $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $provider = new ProviderVO;

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $provider->setId($row["id"]);
    $provider->setUsername($row["username"]);
    $provider->setName($row["name"]);
    $provider->setSurname($row["surname"]);
    $provider->setPhone($row["phone"]);
    $provider->setOffice($row["office"]);
    $provider->setEmail($row["email"]);

    return $provider;
  }

  public function getProviderByUsername($username){
    $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $providers = [];
    $provider = new ProviderVO;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $provider->setId($row["id"]);
      $provider->setUsername($row["username"]);
      $provider->setName($row["name"]);
      $provider->setSurname($row["surname"]);
      $provider->setPhone($row["phone"]);
      $provider->setOffice($row["office"]);
      $provider->setEmail($row["email"]);

      array_push($providers, $provider);
    }

    return $providers;
  }

  public function getProviderByName($name){
    $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE name = :name");
    $stmt->bindParam(':name', $name);
    $stmt->execute();

    $providers = [];
    $provider = new ProviderVO;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $provider->setId($row["id"]);
      $provider->setUsername($row["username"]);
      $provider->setName($row["name"]);
      $provider->setSurname($row["surname"]);
      $provider->setPhone($row["phone"]);
      $provider->setOffice($row["office"]);
      $provider->setEmail($row["email"]);

      array_push($providers, $provider);
    }

    return $providers;
  }

  public function getProviderBySurname($surname){
    $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE surname = :surname");
    $stmt->bindParam(':surname', $surname);
    $stmt->execute();

    $providers = [];
    $provider = new ProviderVO;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $provider->setId($row["id"]);
      $provider->setUsername($row["username"]);
      $provider->setName($row["name"]);
      $provider->setSurname($row["surname"]);
      $provider->setPhone($row["phone"]);
      $provider->setOffice($row["office"]);
      $provider->setEmail($row["email"]);

      array_push($providers, $provider);
    }

    return $providers;
  }

  public function getProviderByPhone($phone){
    $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE phone = :phone");
    $stmt->bindParam(':phone', $phone);
    $stmt->execute();

    $providers = [];
    $provider = new ProviderVO;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $provider->setId($row["id"]);
      $provider->setUsername($row["username"]);
      $provider->setName($row["name"]);
      $provider->setSurname($row["surname"]);
      $provider->setPhone($row["phone"]);
      $provider->setOffice($row["office"]);
      $provider->setEmail($row["email"]);

      array_push($providers, $provider);
    }

    return $providers;
  }

  public function getProviderByOffice($office){
    $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE office = :office");
    $stmt->bindParam(':office', $office);
    $stmt->execute();

    $providers = [];
    $provider = new ProviderVO;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $provider->setId($row["id"]);
      $provider->setUsername($row["username"]);
      $provider->setName($row["name"]);
      $provider->setSurname($row["surname"]);
      $provider->setPhone($row["phone"]);
      $provider->setOffice($row["office"]);
      $provider->setEmail($row["email"]);

      array_push($providers, $provider);
    }

    return $providers;
  }

  public function getProviderByEmail($email){
    $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $providers = [];
    $provider = new ProviderVO;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $provider->setId($row["id"]);
      $provider->setUsername($row["username"]);
      $provider->setName($row["name"]);
      $provider->setSurname($row["surname"]);
      $provider->setPhone($row["phone"]);
      $provider->setOffice($row["office"]);
      $provider->setEmail($row["email"]);

      array_push($providers, $provider);
    }

    return $providers;
  }

  public function addProvider($provider){
    $stmt = $this->pdo->prepare("INSERT INTO $this->_tableName
      (name, username, surname, phone, office, email)
      VALUES (:name, :username, :surname, :phone, :office, :email)");

      $stmt->bindParam(':name', $provider->getName());
      $stmt->bindParam(':username', $provider->getUsername());
      $stmt->bindParam(':surname', $provider->getSurname());
      $stmt->bindParam(':phone', $provider->getPhone());
      $stmt->bindParam(':office', $provider->getOffice());
      $stmt->bindParam(':email', $provider->getEmail());

      $stmt->execute();
    }

  }


  ?>
