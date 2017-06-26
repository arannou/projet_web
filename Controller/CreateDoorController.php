<?php

class CreateDoorController {

    public $pageName;

    public function __construct(){
        if(isset($_POST['room']) && isset($_POST['lock'])){

            $createDoor = implementationDoorService::getInstance();
            $door = $createDoor->createDoor($_POST['room']);

            $daoFactory = getDAOFactory();
            $lockDAO    = $daoFactory->getLockDAO();

            $lock = $lockDAO->getLockById($_POST['lock']);
            if($lock != null){
                $lock->setDoorId($door->getId());
                $lockDAO->update($lock);
            }

        }

    }




}
