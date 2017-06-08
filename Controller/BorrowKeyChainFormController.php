<?php

class BorrowKeyChainFormController {

    public $pageName;
    public $keychains;
    public $availableKeychains;
    public $borrowings;
    public $keys;
    public $availableKeys;
    public $error;
    public $keychainsKeys;
    public $roomsNames;

    public function __construct($pageName){
        $this->pageName = $pageName;

        $keychainDAO = implementationKeychainDAO_Dummy::getInstance();
        $usersDAO    = implementationUserDAO_Dummy::getInstance();
        $keyDAO      = implementationKeyDAO_Dummy::getInstance();
        $keyService  = implementationKeyService_Dummy::getInstance();
        $borrowService = implementationBorrowService_Dummy::getInstance();
        $lockDAO     = implementationLockDAO_Session::getInstance();
        $doorDAO     = implementationDoorDAO_Dummy::getInstance();


        $this->keychains = $keychainDAO->getKeychains();
        $currentBorrowings = $borrowService->getCurrentBorrowings();

        $this->keychainsKeys = [];
        $this->roomsNames = [];
        $this->availableKeychains = [];

        foreach ($this->keychains as $index => $keychain) {
            $keys = $keyDAO->getKeysByKeychainId($keychain->getId());

            $ids = [];
            $rooms = [];
            foreach ($keys as $index2 => $key) {
                array_push($ids, $key->getId());

                $lockId = $key->getLockId();
                $lock   = $lockDAO->getLockById($lockId);
                $doorId = $lock->getDoorId();;
                $door   = $doorDAO->getDoorById($doorId);

                array_push($rooms, $door->getRoomId());
            }

            $isKeychainAvailable = true;
            foreach ($currentBorrowings as $key => $borrowing) {
                if($borrowing['keychainId'] == $keychain->getId()){
                    $isKeychainAvailable = false;
                }
            }

            if($isKeychainAvailable){
                array_push($this->availableKeychains, $keychain);
            }

            array_push($this->roomsNames, $rooms);
            array_push($this->keychainsKeys, $ids);
        }


        $this->users         = $usersDAO->getUsers();
        $this->keys          = $keyDAO->getKeys();
        $this->availableKeys = $keyService->getAvailableKeys();

        $keyService = implementationKeyService_Dummy::getInstance();
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
