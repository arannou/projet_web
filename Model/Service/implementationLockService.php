<?php
require_once 'Model/Service/interfaceLockService.php';

class implementationLockService implements interfaceLockService
{
    private $_lockDAO;

    public function createLock($id, $length){
        $this->_lockDAO = implementationLockDAO_Session::getInstance();

        $lock = new LockVO;
        $lock->setId($id);
        $lock->setLength($length);

        $this->_lockDAO->addLock($lock);
    }
}

?>
