<?php

class LocksSupprController {

    public $pageName;

    public function __construct(){
        $lockService    = implementationLockService::getInstance();
        $lockService->deleteLock($_POST['idCanon']);
    }
}
