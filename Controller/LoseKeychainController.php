<?php

class LoseKeychainController {

    public function __construct(){
		if(isset($_POST['id']) && isset($_POST['comment'])){
			echo "id: ".$_POST['id'].", comment: ".$_POST['comment'];
			$loseKeychain= implementationBorrowService_Dummy::getInstance();
			$loseKeychain->lostKeychain(intval($_POST['id']), $_POST['comment']);

		}
    }
}
