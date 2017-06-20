<?php

class extendBorrowingController {

    public function __construct(){
  		if(isset($_POST['id']) && isset($_POST['newDueDate'])){
  			$keychain = implementationBorrowService::getInstance();
  			$keychain->setNewDueDate($_POST['id'], new DateTime($_POST['newDueDate']));
  		}
    }
}
