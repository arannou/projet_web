<?php
require_once 'Model/VO/KeyVO.php';
require_once 'Model/DAO/interfaceKeyDAO.php';
class implementationKeyDAO_MYSQL extends ImplementationDAO_MYSQL implements interfaceKeyDAO
{

  /**
  * @var Singleton
  * @access private
  * @static
  */
  private static $_instance = null;
  private $_tableName       = "enssat_key";

  private function __construct(){
    parent::initDb();
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
      self::$_instance = new implementationKeyDAO_MYSQL();
    }

    return self::$_instance;
  }


  public function populate() {
    if (file_exists(dirname(__FILE__).'/keys.xml')) {
      $keys = simplexml_load_file(dirname(__FILE__).'/keys.xml');
      foreach($keys as $xmlkey)
      {
        $key = new keyVO;
        $key->setId(intval($xmlkey->id));
        $key->setType((string)$xmlkey->type);
        $key->setLockId((int)$xmlkey->lockId);

        $this->addKey($key);
      }
    } else {
      throw new RuntimeException('Echec lors de l\'ouverture du fichier keys.xml.');
    }
  }

  public function getKeys(){
    $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName");
    $stmt->execute();

    $keys = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $key = new keyVO;
      $key->setId($row["id"]);
      $key->setType($row["type"]);
      $key->setLockId($row["lockId"]);

      array_push($keys, $key);
    }

    return $keys;
  }

  public function getKeyById($id){
    $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $key = null;
    if($row != false) {
      $key = new keyVO;
      $key->setId($row["id"]);
      $key->setType($row["type"]);
      $key->setLockId($row["lockId"]);
    }
    return $key;
  }

  public function addKey($key){
    $stmt = $this->pdo->prepare("INSERT INTO $this->_tableName
      (type, lockId)
      VALUES (:type, :lock_id)");

      $k_type = $key->getType();
      $k_lock_id = $key->getLockId();

      $stmt->bindParam(':type', $k_type);
      $stmt->bindParam(':lock_id', $k_lock_id);
      $stmt->execute();
    }

    public function getKeychainOfKey($keychainId, $keyId) {
      if($keychainId == $this->getKeyById($keyId)->getKeychainId()) {
        return $keychainId;
      }
      return null;
    }

    public function updateKey($updatedKey){
      $keyId = $updatedKey->getId();
      $keys = $this->getKeys();
      foreach ($keys as $index => $key) {
        if($key->getId() == $keyId){
          $stmt = $this->pdo->prepare("UDAPTE $this->_tableName  SET
          (type, lock_id) = (:type, :lock_id) WHERE id=:id");
          $k_id = $key->getId();
          $k_type = $key->getType();
          $k_lock_id = $key->getType();

          $stmt->bindParam(':id', $k_id);
          $stmt->bindParam(':type', $k_type);
          $stmt->bindParam(':lock_id', $k_lock_id);
          $stmt->execute();
        }
      }

    }

    public function getKeyByLockId($lockId){
      foreach ($this->getKeys() as $index => $key) {
        if($key->getLockId() == $lockId) {
          return $key;
        }
      }
      return null;
    }

  }

  ?>
