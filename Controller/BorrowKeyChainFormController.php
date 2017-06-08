<?php

class BorrowKeyChainFormController {

    public $pageName;
    public $keychains;
    public $borrowings;
    public $keys;
    public $availableKeys;
    public $error;
    public $keychainsKeys;

    public function __construct($pageName){
        $this->pageName = $pageName;

        $keychainDAO = implementationKeychainDAO_Dummy::getInstance();
        $usersDAO    = implementationUserDAO_Dummy::getInstance();
        $keyDAO      = implementationKeyDAO_Dummy::getInstance();
        $keyService  = implementationKeyService_Dummy::getInstance();


        $this->keychains = $keychainDAO->getKeychains();
        $this->keychainsKeys = [];
        foreach ($this->keychains as $index => $keychain) {
            $keys = $keyDAO->getKeysByKeychainId($keychain->getId());

            $ids = [];
            foreach ($keys as $index2 => $key) {
                array_push($ids, $key->getId());
            }

            array_push($this->keychainsKeys, $ids);
        }

        $this->users         = $usersDAO->getUsers();
        $this->keys          = $keyDAO->getKeys();
        $this->availableKeys = $keyService->getAvailableKeys();

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
