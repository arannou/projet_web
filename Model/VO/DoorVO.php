<?php
class PassVO
{
    protected $id;
	protected $idRoom;
	protected $idLock;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
	
	    public function setIdRoom($idRoom) {
        $this->idRoom = $idRoom;
    }

    public function getIdRoom() {
        return $this->idRoom;
    }
	
	    public function setIdLock($idLock) {
        $this->idLock = $idLock;
    }

    public function getIdLock() {
        return $this->idLock;
    }


}
