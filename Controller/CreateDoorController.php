<?php

class CreateDoorController {

    public $pageName;

    public function __construct(){
       if(isset($_POST['room']) && isset($_POST['lock'])){

            $createDoor    = implementationDoorService::getInstance();

            $createDoor->createDoor($_POST['room'], $_POST['lock']);

        }

    }

	
	

}
