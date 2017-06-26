<?php
class RoomVO
{
    /**
     * @var Identifiant de la salle
     */
    protected $id;

    /**
     * @param $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return Identifiant
     */
    public function getId() {
        return $this->id;
    }
    

}
