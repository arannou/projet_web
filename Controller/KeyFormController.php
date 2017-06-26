<?php

class KeyFormController {

  public $service;

  public function __construct(){
    $DAO = implementationKeyDAO_Session::getInstance();
    $this->service = implementationKeyService::getInstance();
    if (isset($_POST['keyId']) && !empty($_POST['keyId'])) {
      $this->service->createKey($_POST['keyId'], $_POST['keyType'], $_POST['lockId']);
    }
  }
}
