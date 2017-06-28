<?php

class CreateDoorController {

    public $pageName;

    public function __construct(){
        if(isset($_POST['room'])){

            $createDoor = implementationDoorService::getInstance();
            $door = $createDoor->createDoor($_POST['room']);
        }

    }




}
