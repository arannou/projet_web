<?php
class DoorVO
{
    /**
     * @var identifiant de la porte
     */
  protected $id;
    /**
     * @var identifiant  de la salle
     */
  protected $roomId;

    /**
     * @param $id
     */
  public function setId($id) {
    $this->id = $id;
  }

    /**
     * @return mixed
     */
  public function getId() {
    return $this->id;
  }

    /**
     * @param $roomId
     */
  public function setRoomId($roomId) {
    $this->roomId = $roomId;
  }

    /**
     * @return mixed
     */
  public function getRoomId() {
    return $this->roomId;
  }
}
