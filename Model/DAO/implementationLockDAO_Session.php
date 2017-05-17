<?php
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
     if (file_exists(dirname(__FILE__).'/locks.xml')) {
       $locks = simplexml_load_file(dirname(__FILE__).'/locks.xml');
       foreach($locks->children() as $xmlLock)
       {
         $lock = new LockVO();
         $lock->setId($xmlLock->id);
         $lock->setLength($xmlLock->length);
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

   public function getLockById(){
       foreach ($this->getLocks() as $key => $lock) {
           if($lock['id'] == $id){
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
       $_SESSION['locks'][] = $lock;
   }

   public function removeLockById($id){
       foreach ($this->getLocks() as $key => $lock) {
           if($lock['length'] == $length){
               return $lock;
           }
       }
   }

}


?>
