<?php

class LocksController {

    public $pageName;
    public $locks;
    public $doors;

    public function __construct($pageName){
        $this->pageName = $pageName;
        $DAO = implementationLockDAO_Session::getInstance();
        $this->locks = $DAO->getLocks();

        $doorDAO = implementationDoorDAO_Dummy::getInstance();
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

}
