<?php

class CreateDoorFormController {

    public $pageName;
    public $doors;
	public $rooms;

    public function __construct($pageName){
        $this->pageName = $pageName;
		
        $DAO = implementationDoorDAO_Dummy::getInstance();
        $this->doors = $DAO->getDoors();
        $roomDAO        = implementationRoomDAO_Session::getInstance();
        $this->rooms    = $roomDAO->getRooms();
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
