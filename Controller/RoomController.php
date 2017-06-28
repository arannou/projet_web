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
            $doors = $doorDAO->getDoorByRoomId($room->getId());

            foreach ($doors as $door) {

                $lock = null;
                if ($door != null) {
                    $lock = $lockDAO->getLockByDoorId($door->getId());
                    $this->locks[$room->getId()] = $lock;
                }
                if ($lock != null) {
                    $key = $keyDAO->getKeyByLockId($lock->getId());
                    $this->keys[$room->getId()] = $key;
                }
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
