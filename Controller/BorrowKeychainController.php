<?php

class BorrowKeychainController {

    public $pageName;

    public function __construct(){
        $borrowService    = implementationBorrowService_Dummy::getInstance();
        var_dump($_POST);
        $dt = new DateTime($_POST['borrowDate']);
        $borrowService->borrowKeychain($_POST['userEnssatPrimaryKey'], $_POST['keychainId'], $dt);


    }


}
