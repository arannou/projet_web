<?php

class LocksController {

    public $pageName;
    public $locks;
    public $doors;
    public $roomIds = [];

    public function __construct($pageName){

      $this->pageName = $pageName;
        $DAO = implementationLockDAO_Session::getInstance();
        $this->locks = $DAO->getLocks();

        $doorDAO = implementationDoorDAO_Session::getInstance();

        $providersDAO = implementationFournisseurDAO_Session::getInstance();
        $this->providers = $providersDAO->getProviders();
/*
        foreach ($this->locks as $key => $lock) {
            $roomId = $doorDAO->getDoorById($lock->getDoorId())->getRoomId();
            array_push($this->roomIds, $roomId);
        }*/

        $this->doors = $doorDAO->getDoors();
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
