<?php
class DoorVO
{
  protected $id;
  protected $roomId;
  protected $idLock;

  public function setId($id) {
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function setRoomId($roomId) {
    $this->roomId = $roomId;
  }

  public function getRoomId() {
    return $this->roomId;
  }

  public function setLockId($idLock) {
    $this->idLock = $idLock;
  }

  public function getLockId() {
    return $this->idLock;
  }


}
