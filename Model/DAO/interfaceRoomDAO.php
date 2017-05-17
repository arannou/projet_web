<?php

interface interfaceRoomDAO
{

    // Singleton
    public static function getInstance();

    public function getRooms();

    public function getRoomById($id);

    public function addRoom($room);

}

?>
