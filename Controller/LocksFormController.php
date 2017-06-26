<?php

class LocksFormController {

    public function __construct(){
        $lockService    = implementationLockService::getInstance();
        $lockService->createLock($_POST['lengthCanon'], $_POST['providerCanon']);
    }
}
