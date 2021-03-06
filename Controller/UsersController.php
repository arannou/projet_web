<?php

class UsersController {

    public $pageName;
    public $users;
    public $keychain;
    public $borrowByUser;
    public $keysOfKeychains;
    public $doors;

    public function __construct($pageName){
        $this->pageName = $pageName;

        $factory = getDAOFactory();

        $DAO = $factory->getUserDAO();
        $this->users = $DAO->getUsers();
        $serviceBorrow = implementationBorrowService::getInstance();
        $serviceKey = implementationKeyService::getInstance();
        $keyKeychainDAO = $factory->getKeychainDAO();

        $this->borrowByUser = [];
        foreach ($this->users as $key => $user) {
          $this->borrowByUser[$user->getEnssatPrimaryKey()] = $serviceBorrow->getBorrowingByEnssatPrimaryKey($user->getEnssatPrimaryKey());
        }

        $this->keysOfKeychains = [];
        foreach ($this->users as $key => $user) {
          foreach ($this->borrowByUser[$user->getEnssatPrimaryKey()] as $index => $keyBorrow) {
            $this->keysOfKeychains[$keyBorrow['borrowingId']] = $keyKeychainDAO->getKeysByKeychainId($keyBorrow['keychainId']);
          }
        }

        $this->doors = [];
        foreach ($this->keysOfKeychains as $index => $keys) {
          $keyId = [];
          foreach ($keys as $index2 => $key) {
            $keyId[] = $serviceKey->getDoorByKeyId($key->getId());
          }
          $this->doors[] = $keyId;
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
