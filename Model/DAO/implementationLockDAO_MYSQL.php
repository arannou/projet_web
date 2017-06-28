<?php
require_once 'Model/VO/LockVO.php';

require_once 'Model/DAO/interfaceLockDAO.php';

class implementationLockDAO_MYSQL extends implementationDAO_MYSQL implements interfaceLockDAO
{

  /**
   * @var Singleton
   * @access private
   * @static
   */
   private static $_instance = null;
   private $_tableName       = "enssat_lock";


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
       if (file_exists(dirname(__FILE__).'/locks.xml')) {
         $locks = simplexml_load_file(dirname(__FILE__).'/locks.xml');
         foreach($locks->children() as $xmlLock)
         {
           $lock = new LockVO();
           $lock->setId(intval($xmlLock->id));
           $lock->setLength(intval($xmlLock->length));
           $lock->setDoorId((string)$xmlLock->doorId);
           $lock->setProvider((string)$xmlLock->providerId);
           $this->addLock($lock);
         }
       } else {
           throw new RuntimeException('Echec lors de l\'ouverture du fichier locks.xml.');
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
       self::$_instance = new implementationLockDAO_MYSQL();
     }

     return self::$_instance;
   }

   public function getLocks(){
       $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName");
       $stmt->execute();

       $locks = [];

       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

           $lock = new LockVO();

           $lock->setId($row['id']);
           $lock->setDoorId($row['doorId']);
           $lock->setLength($row['length']);
           $lock->setProvider($row['providerId']);

           array_push($locks, $lock);
       }

       return $locks;
   }

   public function getLockById($id){
       $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE id = :id");
       $stmt->bindParam(':id', $id);
       $stmt->execute();

       $row = $stmt->fetch(PDO::FETCH_ASSOC);
       $lock = new LockVO();

       $lock->setId($row['id']);
       $lock->setDoorId($row['doorId']);
       $lock->setLength($row['length']);
       $lock->setProvider($row['providerId']);

       return $lock;
   }

   public function getLocksByLength($length){
       $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE length = :length");
       $stmt->bindParam(':length', $length);
       $stmt->execute();

       $locks = [];

       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

           $lock = new LockVO();

           $lock->setId($row['id']);
           $lock->setDoorId($row['doorId']);
           $lock->setLength($row['length']);
           $lock->setProvider($row['providerId']);;

           array_push($locks, $lock);
       }

       return $locks;
   }

   public function addLock($lock){
       $stmt = $this->pdo->prepare("INSERT INTO $this->_tableName
                                      (length, doorId, providerId)
                                      VALUES (:length, :doorId, :provider)");

       $length = $lock->getLength();
       $doorId = $lock->getDoorId();
       $provider = $lock->getProvider();

       $stmt->bindParam(':length', $length);
       $stmt->bindParam(':doorId', $doorId);
       $stmt->bindParam(':provider', $provider);

       $stmt->execute();
   }

   public function removeLockById($id){
       $stmt = $this->pdo->prepare("DELETE * FROM $this->_tableName WHERE id = :id");

       $stmt->bindParam(':id', $id);

       $stmt->execute();

   }

   public function update($lock){

     $stmt = $this->pdo->prepare("UPDATE $this->_tableName
                                    SET length = :length, doorId = :doorId, providerId = :providerId
                                    WHERE id = :lockId");

     $length = $lock->getLength();
     $doorId = $lock->getDoorId();
     $provider = $lock->getProvider();

     $stmt->bindParam(':length', $length);
     $stmt->bindParam(':doorId', $doorId);
     $stmt->bindParam(':provider', $provider);
     $stmt->bindParam(':lockId', $lock->getId());

     $stmt->execute();
   }

   public function getLockByDoorId($doorId) {
       $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE doorId = :doorId");
       $stmt->bindParam(':length', $doorId);
       $stmt->execute();

       $row = $stmt->fetch(PDO::FETCH_ASSOC);

       $lock = new LockVO();
       $lock->setId($row['id']);
       $lock->setDoorId($row['doorId']);
       $lock->setLength($row['length']);
       $lock->setProvider($row['providerId']);

       return $lock;
   }
}
?>
