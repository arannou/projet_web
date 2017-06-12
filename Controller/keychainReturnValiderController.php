<?php

class keychainReturnValiderController {


   public function __construct($id){


 			$borrowService= implementationBorrowService_Dummy::getInstance();
 			$borrowService->returnKeychain((int)$id,"ok");

    }




}
