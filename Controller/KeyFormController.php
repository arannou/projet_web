<?php

class KeyFormController {

  public $service;

  public function __construct(){
    $DAO = implementationKeyDAO_Dummy::getInstance();
    $this->service = implementationKeyService_Dummy::getInstance();
    if (isset($_POST['keyId']) && !empty($_POST['keyId'])) {
      $this->service->createKey($_POST['keyId'], $_POST['keyType'], null, $_POST['lockId']);
    }
  }
}
