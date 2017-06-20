<?php

class BorrowKeychainController {

    public $pageName;

    public function __construct(){

        $borrowService     = implementationBorrowService::getInstance();
        $keychainService   = implementationKeychainService::getInstance();
        $keyService        = implementationKeyService::getInstance();

        if(isset($_POST['keychainSelection'])){
            if($_POST['keychainSelection'] == "creation"){

                if(isset($_POST['keys']) && isset($_POST['dueDate']) && isset($_POST['userEnssatPrimaryKey'])){

                    $keys = json_decode($_POST['keys']);
                    $keychain = null;

                    //verifier la dispo de toutes les clés
                    $allKeyAvailable = true;
                    foreach ($keys as $index => $keyId) {
                        if(!$keychainService->isKeyAvailable($keyId)){
                            $allKeyAvailable = false;
                        }
                    }

                    //Creer un trousseau avec les cles
                    if($allKeyAvailable){
                        $dt = new DateTime();
                        $keychain = $keychainService->createKeychain($dt, null, $keys);
                        $dtDueDate = new DateTime($_POST['dueDate']);
                        $borrowService->borrowKeychain($_POST['userEnssatPrimaryKey'], $keychain->getId(), $dtDueDate);
                    }
                }
            }else if($_POST['keychainSelection'] == "selection"){
                if(isset($_POST['keychainId']) && isset($_POST['dueDate']) && isset($_POST['userEnssatPrimaryKey'])){
                    $dt = new DateTime($_POST['dueDate']);

                    if($borrowService->getBorrowingByKeychainId($_POST['keychainId']) == null){
                        $borrowService->borrowKeychain($_POST['userEnssatPrimaryKey'], $_POST['keychainId'], $dt);
                    }else{
                        $_SESSION['error'] = "Le trousseau demandé est déjà emprunté";
                    }
                }
            }
        }else{

        }
    }
}
