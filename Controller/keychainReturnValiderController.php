<?php

class keychainReturnValiderController {
   public function __construct($id){
	$borrowService= implementationBorrowService::getInstance();
 	$borrowService->returnKeychain((int)$id,"ok");
    }
}
