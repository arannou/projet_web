<?php

class CreateRoomController {
    public function __construct(){
        $createRoom    = implementationRoomService::getInstance();
        if (isset($_POST['roomName']) && !empty($_POST['roomName'])) {
          $createRoom->createRoom($_POST['roomName']);
      }
    }
}
