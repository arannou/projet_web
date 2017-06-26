<?php

interface interfaceRoomDAO
{

    // Singleton
    public function populate();

    public static function getInstance();

    /**
     * Retourne les salles
     *
     * @return mixed
     */
    public function getRooms();

    /**
     * Retourne la salle dont l'identifiant est donné
     *
     * @param $id
     * @return mixed
     */
    public function getRoomById($id);

    /**
     * Ajoute une salle
     *
     * @param $room
     * @return mixed
     */
    public function addRoom($room);

}

?>
