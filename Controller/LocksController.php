<?php

class LocksController {

    public $pageName;
    public $locks;
    public $doors;
    public $roomIds = [];

    public function __construct($pageName){
        $this->pageName = $pageName;
        $DAO = implementationLockDAO_Session::getInstance();
        $this->locks = $DAO->getLocks();

        $doorDAO = implementationDoorDAO_Dummy::getInstance();


        foreach ($this->locks as $key => $lock) {
            $roomId = $doorDAO->getDoorById($lock->getDoorId())->getRoomId();
            array_push($this->roomIds, $roomId);
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

}
