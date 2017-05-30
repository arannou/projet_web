<?php

class BorrowKeyChainFormController {

    public $pageName;
    public $keychains;
    public $borrowings;
    public $error;

    public function __construct($pageName){
        $this->pageName = $pageName;

        $keychainDAO = implementationKeychainDAO_Dummy::getInstance();
        $this->keychains = $keychainDAO->getKeychains();

        $DAO = implementationUserDAO_Dummy::getInstance();
        $this->users = $DAO->getUsers();

        if(isset($_SESSION['error'])){
            $this->error = $_SESSION['error'];
            unset($_SESSION['error']);
        }
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
