<?php

class RoomController {

    public $pageName;
    public $rooms;
    public $locks;
    public $keys;

    public function __construct($pageName){
        $this->pageName = $pageName;

        $factory = getDAOFactory();

        $roomDAO        = $factory->getRoomDAO();
        $doorDAO        = $factory->getDoorDAO();
        $lockDAO        = $factory->getLockDAO();
        $keyDAO         = $factory->getKeyDAO();

        $this->rooms    = $roomDAO->getRooms();

        foreach ($this->rooms as $key => $room) {
          $door = $doorDAO->getDoorByRoomId($room->getId());
			$lock =null;
          if ($door != null) {
            $lock = $lockDAO->getLockByDoorId($door->getId());
            $this->locks[] = $lock;
          } else {
            $this->locks[] = null;
          }
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
