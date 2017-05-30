<?php

class KeysController {

  public $pageName;
  public $keys;

  public function __construct($pageName){
    $this->pageName = $pageName;
    $DAO = implementationKeyDAO_Dummy::getInstance();
    $this->keys = $DAO->getKeys();
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
