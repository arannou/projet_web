<?php

class RoomController {

    public $pageName;
    public $rooms;
    public $locks;
    public $keys;

    public function __construct($pageName){
        $this->pageName = $pageName;

        $roomDAO        = implementationRoomDAO_Session::getInstance();
        $doorDAO        = implementationDoorDAO_Dummy::getInstance();
        $lockDAO        = implementationLockDAO_Session::getInstance();
        $keyDAO         = implementationKeyDAO_Dummy::getInstance();

        $this->rooms    = $roomDAO->getRooms();

        foreach ($this->rooms as $key => $room) {
          $door = $doorDAO->getDoorByRoomId($room->getId());
          $lock = $lockDAO->getLockByDoorId($door->getId());
          $this->locks[] = $lock;
          if ($lock != null) {
              $key = $keyDAO->getKeyByLockId($lock->getId());
              $this->keys[] = $key;
          } else {
            $this->keys[] = null;
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

}
