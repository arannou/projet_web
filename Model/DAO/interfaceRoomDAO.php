<?php

interface interfaceRoomDAO
{

    // Singleton
    public function populate();

    public static function getInstance();

    public function getRooms();

    public function getRoomById($id);

    public function addRoom($room);

}

?>
