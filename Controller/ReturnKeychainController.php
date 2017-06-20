<?php

class ReturnKeychainController {

    public $borrowingId;

    public function __construct($id){
        $this->borrowingId = $id;

        $borrowService = implementationBorrowService::getInstance();

        if(isset($id) && !empty($id)){
            $borrowService->returnKeychain($id, "Rendu");
        }
    }

}