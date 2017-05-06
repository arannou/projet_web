<?php

class UsersController {

    public $pageName;
    public $users;

    public function __construct($pageName){
        $this->pageName = $pageName;
        $DAO = implementationUserDAO_Dummy::getInstance();
        $this->users = $DAO->getUsers();
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
