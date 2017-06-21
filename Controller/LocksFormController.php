<?php

class LocksFormController {

    public $pageName;
    public $locks;

    public function __construct(){
      $lockService    = implementationLockService::getInstance();
      $lockService->createLock($_POST['lengthCanon'], $_POST['providerCanon']);

      $DAO = implementationLockDAO_Session::getInstance();
      $this->locks = $DAO->getLocks();

    }
}
