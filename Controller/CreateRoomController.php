<?php

class CreateRoomController {
    public function __construct(){
        $createRoom    = implementationRoomService::getInstance();
        $createRoom->createRoom($_POST['roomName']);
        var_dump($_SESSION);

    }


}