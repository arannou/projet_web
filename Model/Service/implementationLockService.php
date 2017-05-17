<?php
require_once 'Model/Service/interfaceLockService.php';

class implementationLockService implements interfaceLockService
{
    private $lockDAO;

    public function createLock($id, $length){
        $this->lockDAO = implementationLockDAO_Session::getInstance();
    }
}

?>
