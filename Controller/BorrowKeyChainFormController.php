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
        $factory = getDAOFactory();

        $keychainDAO    = $factory->getKeychainDAO();
        $usersDAO       = $factory->getUserDAO();
        $keyDAO         = $factory->getKeyDAO();
        $lockDAO        = $factory->getLockDAO();
        $doorDAO        = $factory->getDoorDAO();

        $keyService     = implementationKeyService::getInstance();
        $borrowService  = implementationBorrowService::getInstance();

        $this->keychains = $keychainDAO->getKeychains();
        $currentBorrowings = $borrowService->getCurrentBorrowings();

        $this->keychainsKeys = [];
        $this->roomsNames = [];
        $this->availableKeychains = [];

        foreach ($this->keychains as $index => $keychain) {
            $keys = $keychain->getKeys();

            $ids = [];
            $rooms = [];

            $isKeychainAvailable = true;
            foreach ($currentBorrowings as $key => $borrowing) {
                if($borrowing['keychainId'] == $keychain->getId()){
                    $isKeychainAvailable = false;
                }
            }


            foreach ($keys as $index2 => $key) {

                array_push($ids, $key->getId());

                if($isKeychainAvailable && $keychain->getDestructionDate() == null) {

                    $lockId = $key->getLockId();
                    $lock = $lockDAO->getLockById($lockId);

                    $door = null;
                    $did = null;

                    if ($lock != null) {
                        $doorId = $lock->getDoorId();
                        $door = $doorDAO->getDoorById($doorId);

                        if ($door != null) {
                            $did = $door->getRoomId();
                        }
                    }

                    if ($did != null) {
                        array_push($rooms, $did);
                    }
                }
            }

            if($isKeychainAvailable && $keychain->getDestructionDate() == null){
                array_push($this->availableKeychains, $keychain);
                array_push($this->roomsNames, $rooms);
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