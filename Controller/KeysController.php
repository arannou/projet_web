<?php

class KeysController {

  public $pageName;
  public $keys;
  public $doors;
  public $locks;

  public function __construct($pageName){
    $this->pageName = $pageName;
    $DAO            = implementationKeyDAO_Dummy::getInstance();
    $this->keys     = $DAO->getKeys();
    $keyService     = implementationKeyService_Dummy::getInstance();
    $lockDAO        = implementationLockDAO_Session::getInstance();

    $this->doors    = [];
    foreach ($this->keys as $index => $key) {
      $this->doors[] = $keyService->getDoorByKeyId($key->getId());
    }

    $this->locks    = $lockDAO->getLocks();


  }

  /**
  * Get the value of Page Name
  *
  * @return mixed
  */
  public function getPageName()
  {
    return $this->pageName;
  }

  /**
  * Set the value of Page Name
  *
  * @param mixed pageName
  *
  * @return self
  */
  public function setPageName($pageName)
  {
    $this->pageName = $pageName;

    return $this;
  }
}
