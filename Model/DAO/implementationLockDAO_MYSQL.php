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
     /**/
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

           $lock->setId($row['lock']);
           $lock->setDoorId($row['doorId']);
           $lock->setLength($row['length']);
           $lock->setProvider($row['provider']);

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

       $lock->setId($row['lock']);
       $lock->setDoorId($row['doorId']);
       $lock->setLength($row['length']);
       $lock->setProvider($row['provider']);

       return $lock;
   }

   public function getLocksByLength($length){
       $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE length = :length");
       $stmt->bindParam(':length', $length);
       $stmt->execute();

       $locks = [];

       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

           $lock = new LockVO();

           $lock->setId($row['lock']);
           $lock->setDoorId($row['doorId']);
           $lock->setLength($row['length']);
           $lock->setProvider($row['provider']);

           array_push($locks, $lock);
       }

       return $locks;
   }

   public function addLock($lock){
       $stmt = $this->pdo->prepare("INSERT INTO $this->_tableName 
                                      (length, doorId, provider) 
                                      VALUES (:length, :doorId, :provider)");

       $stmt->bindParam(':length', $lock->getLength());
       $stmt->bindParam(':doorId', $lock->getDoorId());
       $stmt->bindParam(':provider', $lock->getProvider());

       $stmt->execute();
   }

   public function removeLockById($id){
       $stmt = $this->pdo->prepare("DELETE * FROM $this->_tableName WHERE id = :id");

       $stmt->bindParam(':id', $id);

       $stmt->execute();

   }

   public function getLockByDoorId($doorId) {
       $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE doorId = :doorId");
       $stmt->bindParam(':length', $doorId);
       $stmt->execute();

       $row = $stmt->fetch(PDO::FETCH_ASSOC);

       $lock = new LockVO();
       $lock->setId($row['lock']);
       $lock->setDoorId($row['doorId']);
       $lock->setLength($row['length']);
       $lock->setProvider($row['provider']);

       return $lock;
   }
}
?>
