<?php
require_once 'Model/VO/LockVO.php';
require_once 'Model/DAO/interfaceLockDAO.php';

class implementationLockDAO_Session implements interfaceLockDAO
{

  private $_keys = array();

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
       self::$_instance = new implementationLockDAO_Session();
     }

     return self::$_instance;
   }

   public function getLocks(){
       return $_SESSION['locks'];
   }

   public function getLockById($id){
       foreach ($this->getLocks() as $key => $lock) {
           if($lock->getId() == $id){
               return $lock;
           }
       }

       return null;
   }

   public function getLocksByLength($length){
       foreach ($this->getLocks() as $key => $lock) {
           if($lock['length'] == $length){
               return $lock;
           }
       }

       return null;
   }

   public function addLock($lock){
       array_push($_SESSION['locks'], $lock);
   }

   public function update($lock){
       $id = null;
       foreach ($_SESSION["lock"] as $index => $l){
           if($l->getid() == $lock->getId()){
               $id = $index;
           }
       }

       if($id != null){
           $_SESSION["lock"][$id] = $lock;
       }
   }

   public function removeLockById($id){
       $cpt=0;
       foreach($this->getLocks() as $key => $lock){
         if($lock->getId() == $id){
           array_splice($_SESSION['locks'],$cpt,1);
           break;
         }
         $cpt++;
       }

   }

   public function getLockByDoorId($doorId) {
     foreach ($this->getLocks() as $key => $lock) {
         if($lock->getDoorId() == $doorId){
             return $lock;
         }
     }
     return null;
   }
}
?>
