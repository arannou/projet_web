<?php

class UsersController {

    public $pageName;
    public $users;
    public $keychain;
    public $borrowByUser;
    public $keysOfKeychains;

    public function __construct($pageName){
        $this->pageName = $pageName;
        $DAO = implementationUserDAO_Dummy::getInstance();
        $this->users = $DAO->getUsers();
        $serviceBorrow = implementationBorrowService_Dummy::getInstance();
        $serviceKey = implementationKeyService_Dummy::getInstance();
        $this->borrowByUser = [];
        foreach ($this->users as $key => $user) {
          $this->borrowByUser[$user->getEnssatPrimaryKey()] = $serviceBorrow->getBorrowingByEnssatPrimaryKey($user->getEnssatPrimaryKey());
        }
        $this->keysOfKeychains = [];
        foreach ($this->users as $key => $user) {
          foreach ($this->borrowByUser[$user->getEnssatPrimaryKey()] as $index => $keyBorrow) {
            $this->keysOfKeychains[$user->getEnssatPrimaryKey()] = $serviceKey->getKeysOfKeychain($keyBorrow['keychainId']);
          }

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
