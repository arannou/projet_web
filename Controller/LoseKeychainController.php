<?php

class LoseKeychainController {

    public function __construct(){
		if(isset($_POST['id']) && isset($_POST['comment'])){
			$loseKeychain= implementationBorrowService::getInstance();
			$loseKeychain->lostKeychain(intval($_POST['id']), $_POST['comment']);
			
		}
    }
}
