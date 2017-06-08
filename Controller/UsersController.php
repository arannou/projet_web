<?php

class UsersController {

    public $pageName;
    public $users;
    public $keychain;
    public $borrowByUser;

    public function __construct($pageName){
        $this->pageName = $pageName;
        $DAO = implementationUserDAO_Dummy::getInstance();
        $this->users = $DAO->getUsers();
        $serviceBorrow = implementationBorrowService_Dummy::getInstance();
        $this->borrowByUser = [];
        foreach ($this->users as $key => $user) {
          $this->borrowByUser[$user->getEnssatPrimaryKey()] = $serviceBorrow->getBorrowingByEnssatPrimaryKey($user->getEnssatPrimaryKey());
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
