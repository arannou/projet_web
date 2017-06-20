<?php

class DoorsController {

    public $pageName;
    public $doors;


    public function __construct($pageName){
        $this->pageName = $pageName;
        $DAO = implementationDoorDAO_Session::getInstance();
        $this->doors = $DAO->getDoors();
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
