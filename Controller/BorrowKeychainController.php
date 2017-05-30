<?php

class BorrowKeychainController {

    public $pageName;

    public function __construct(){
        if(isset($_POST['keychainId']) && isset($_POST['dueDate']) && isset($_POST['userEnssatPrimaryKey'])){

            $borrowService    = implementationBorrowService_Dummy::getInstance();
            $dt = new DateTime($_POST['dueDate']);

            if($borrowService->getBorrowingByKeychainId($_POST['keychainId']) == null){
                $borrowService->borrowKeychain($_POST['userEnssatPrimaryKey'], $_POST['keychainId'], $dt);
            }else{
                $_SESSION['error'] = "Le trousseau demandé est déjà emprunté";
            }
            
        }
    }
}
