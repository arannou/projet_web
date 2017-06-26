<?php
require_once 'Model/Service/interfaceLockService.php';
require_once 'Model/DAO/implementationLockDAO_Session.php';

class implementationLockService implements interfaceLockService
{
    private $_lockDAO;
    private static $_instance;

    private function __construct()
    {
      $this->_lockDAO       = implementationLockDAO_Session::getInstance();

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
           self::$_instance = new implementationLockService();
       }

         return self::$_instance;
       }

    public function createLock($length, $provider){
        $lock = new LockVO();
        $doorId=null;
        $locks = $this->_lockDAO->getLocks();
        $LastIdItemArray=end($locks);
        var_dump($LastIdItemArray);
        if($LastIdItemArray == false){
          $lock->setId(1);
        }
        else{
          $LastIdItemArray=$LastIdItemArray->getId();
          $lock->setId($LastIdItemArray+1);
        }

        //$lock->setId(count($this->_lockDAO->getLocks())+1);
        $lock->setLength($length);
        $lock->setProvider($provider);
        $lock->setDoorId($doorId);
        $this->_lockDAO->addLock($lock);
    }

    public function deleteLock($id){
        $this->_lockDAO->removeLockById($id);
    }
}

?>
