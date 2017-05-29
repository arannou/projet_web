<?php

class RoomController {

    public $pageName;
    public $rooms;

    public function __construct($pageName){
        $this->pageName = $pageName;
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

}
