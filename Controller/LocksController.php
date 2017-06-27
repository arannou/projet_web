<?php

class LocksController {

    public $pageName;
    public $locks;
    public $doors;
    public $roomIds = [];

    public function __construct($pageName){

        $this->pageName = $pageName;

        $factory = getDAOFactory();

        $DAO = $factory->getLockDAO();
        $this->locks = $DAO->getLocks();

        $doorDAO = $factory->getDoorDAO();

        $providersDAO = $factory->getFournisseurDAO();
        $this->providers = $providersDAO->getProviders();

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
