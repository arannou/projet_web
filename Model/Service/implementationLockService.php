<?php
require_once 'Model/Service/interfaceLockService.php';
require_once 'Model/DAO/implementationLockDAO_Session.php';

class implementationLockService implements interfaceLockService
{
    private $_lockDAO;
    private static $_instance;

    private function __construct()
    {
        $factory = getDAOFactory();

        $this->_lockDAO = $factory->getLockDAO();
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

    //Créaction de canon
    public function createLock($length, $provider, $doorId){
        $lock = new LockVO();
        $locks = $this->_lockDAO->getLocks();
        $LastIdItemArray = end($locks);

        if($LastIdItemArray == false){
          $lock->setId(1);
        } else {
          $LastIdItemArray=$LastIdItemArray->getId();
          $lock->setId($LastIdItemArray+1);
        }

        $lock->setLength($length);
        $lock->setProvider($provider);
        $lock->setDoorId($doorId);
        $this->_lockDAO->addLock($lock);
    }

    //Suppression de canon
    public function deleteLock($id){
        $this->_lockDAO->removeLockById($id);
    }
}

?>
