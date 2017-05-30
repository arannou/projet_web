<?php

class FournisseurController {

    public $pageName;
    public $providers;

    public function __construct($pageName){
        $this->pageName = $pageName;
        $DAO = implementationFournisseurDAO_Session::getInstance();
        $this->providers = $DAO->getProviders();
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
