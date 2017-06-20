<?php

require_once 'Model/VO/KeychainVO.php';
require_once 'Model/VO/UserVO.php';
require_once 'Model/VO/KeyVO.php';
require_once 'Model/VO/DoorVO.php';
require_once 'Model/VO/RoomVO.php';
require_once 'Model/VO/LockVO.php';

session_start();
require_once 'Libs/limonade/limonade.php';

if(!isset($_SESSION['borrowings'])){
    $_SESSION['borrowings'] = array();
}

if(!isset($_SESSION['keyKeychain'])){
    $_SESSION['keyKeychain'] = array();
}

if(!isset($_SESSION['locks'])){
    $_SESSION['locks'] = array();
}

if(!isset($_SESSION['rooms'])){
    $_SESSION['rooms'] = array();
}

if(!isset($_SESSION['keys'])){
    $_SESSION['keys'] = array();
}

if(!isset($_SESSION['keychains'])){
    $_SESSION['keychains'] = array();
}

if(!isset($_SESSION['doors'])){
    $_SESSION['doors'] = array();
}

if(!isset($_SESSION['users'])){
    $_SESSION['users'] = array();
}

if(!isset($_SESSION['providers'])){
    $_SESSION['providers'] = [];
}

dispatch('/clearsession', 'clearsession');
function clearsession() {
    session_destroy();
    session_start();
}

dispatch('/populateDatabase', 'populateDatabase');
function populateDatabase(){
    $_SESSION['borrowings'] = array();
    $_SESSION['locks'] = array();
    $_SESSION['rooms'] = array();
    $_SESSION['keys'] = array();
    $_SESSION['keychains'] = array();
    $_SESSION['doors'] = array();
    $_SESSION['users'] = array();

    require_once 'Model/DAO/implementationDoorDAO_Session.php';
    $doorDAO = implementationDoorDAO_Session::getInstance();
    $doorDAO->populate();

    require_once 'Model/DAO/implementationKeychainDAO_Session.php';
    $keyChainDAO = implementationKeychainDAO_Session::getInstance();
    //$keyChainDAO->populate();

    require_once 'Model/DAO/implementationKeyDAO_Session.php';
    $keyDAO = implementationKeyDAO_Session::getInstance();
    //$keyDAO->populate();

    require_once 'Model/DAO/implementationLockDAO_Session.php';
    $lockDAO = implementationLockDAO_Session::getInstance();
    $lockDAO->populate();

    require_once 'Model/DAO/implementationRoomDAO_Session.php';
    $roomDAO = implementationRoomDAO_Session::getInstance();
    $roomDAO->populate();

    require_once 'Model/DAO/implementationUserDAO_Session.php';
    $userDAO = implementationUserDAO_Session::getInstance();
    $userDAO->populate();

    var_dump($_SESSION);
}

dispatch('/dumpDatabase', 'dumpDatabase');
function dumpDatabase(){
    var_dump($_SESSION);
}

//Page home
dispatch('/', 'home');
function home(){
    //Import des classes
    require_once 'Model/DAO/implementationKeychainDAO_Session.php';
    require_once 'Model/DAO/implementationBorrowingsDAO_Session.php';
    require_once 'Model/DAO/implementationUserDAO_Session.php';
    require_once 'Model/DAO/implementationKeyDAO_Session.php';
    require_once 'Model/Service/implementationBorrowService.php';

    require_once 'Controller/HomeController.php';

    //Appel du controlleur
    $controller = new HomeController("Home");

    //Appel de la vue
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/home.php';
    require 'View/Partial/footer.php';

}

//Utilisateurs
dispatch('/users/', 'users');
function users(){
    //Import des classes
    require_once 'Model/DAO/implementationUserDAO_Session.php';
    require_once 'Controller/UsersController.php';
    require_once 'Model/Service/implementationBorrowService.php';
    require_once 'Model/DAO/implementationKeychainDAO_Session.php';
    require_once 'Model/DAO/implementationKeyKeychainDAO_Session.php';
    require_once 'Model/Service/implementationKeyService.php';
    //Appel du controlleur
    $controller = new UsersController("Users");
    //Appel de la vue
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/users.php';
    require 'View/Partial/footer.php';
}

//Traitement du formulaire CSV
dispatch_post('/uploadUserCSV', 'uploadUserCSV');
function uploadUserCSV(){
    require_once 'Model/Service/implementationUserService.php';
    require_once 'Controller/UploadUserCSVController.php';
    require_once 'Model/DAO/implementationUserDAO_Session.php';

    $controller = new UploadUserCSVController();

    header('location:?/users');
}

dispatch('/keys', 'keys');
function keys(){
    //Import des classes
    require_once 'Model/DAO/implementationKeyDAO_Session.php';
    require_once 'Model/Service/implementationKeyService.php';
    require_once 'Controller/KeysController.php';
    //Appel du controlleur
    $controller = new KeysController("Keys");
    //Appel de la vue
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/keys.php';
    require 'View/Partial/footer.php';
}

//Ajout de clé via formulaire
dispatch_post('/addKeysForm', 'addKeysForm');
function addKeysForm() {
    //Import des classes
    require_once 'Model/DAO/implementationKeyDAO_Session.php';
    require_once 'Model/Service/implementationKeyService.php';
    require_once 'Controller/KeyFormController.php';
    //Appel du controlleur
    $controller = new KeyFormController();

    header('location:?keys');
}


// retourné trousseau

dispatch('/keychainReturn', 'keychainReturn');
function keychainReturn(){
  //Import des classes


  require_once 'Model/DAO/implementationUserDAO_Session.php';
  require_once 'Model/DAO/implementationKeychainDAO_Session.php';
  require_once 'Model/Service/implementationBorrowService.php';
  require_once 'Controller/keychainReturnController.php';
  //Appel du controlleur
  $controller = new keychainReturnController("Return");

  //Appel de la vue
  require 'View/Partial/head.php';
  require 'View/Partial/nav.php';
  //require 'View/home.php';

require 'View/keychainReturn.php';
  require 'View/Partial/footer.php';
 }



 dispatch('/keychainReturnValider/:id', 'keychainReturnValider');
function keychainReturnValider($id){

  require_once 'Model/DAO/implementationKeychainDAO_Session.php';
  require_once 'Model/Service/implementationBorrowService.php';
  require_once 'Controller/keychainReturnValiderController.php';

  $controller = new keychainReturnValiderController($id);

header('location:?/');
//Appel de la vue
require 'View/Partial/head.php';
require 'View/Partial/nav.php';
require 'View/keychainReturn.php';
require 'View/Partial/footer.php';
}

//Emprunt
dispatch('/borrowKeychainForm', 'borrowKeychainForm');
function borrowKeychainForm(){
    //Import des classes
    require_once 'Model/DAO/implementationKeychainDAO_Session.php';
    require_once 'Model/DAO/implementationKeyDAO_Session.php';
    require_once 'Model/DAO/implementationUserDAO_Session.php';
    require_once 'Model/DAO/implementationLockDAO_Session.php';
    require_once 'Model/DAO/implementationDoorDAO_Session.php';
    require_once 'Model/DAO/implementationKeyKeychainDAO_Session.php';
    require_once 'Model/Service/implementationBorrowService.php';
    require_once 'Model/Service/implementationKeyService.php';
    require_once 'Controller/BorrowKeyChainFormController.php';
    //Appel du controller
    $controller = new BorrowKeyChainFormController("Emprunt");
    //Appel de la vue
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/borrowKeychainForm.php';
    require 'View/Partial/footer.php';
}

// trousseau perdu
dispatch('/loseKeychainForm/:id', 'loseKeychainForm');
function loseKeychainForm($id){
    require_once 'Controller/LoseKeychainControllerForm.php';
    require_once 'Model/DAO/implementationKeychainDAO_Session.php';
    require_once 'Model/Service/implementationBorrowService.php';

    $controller = new LoseKeychainControllerForm("Emprunt", $id);
    //Appel de la vue
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/loseKeychainForm.php';
    require 'View/Partial/footer.php';
}

// trousseau perdu (post)
dispatch_post('/loseKeychain/', 'loseKeychain');
function loseKeychain(){
    require_once 'Controller/LoseKeychainController.php';
    require_once 'Model/DAO/implementationUserDAO_Session.php';
    require_once 'Model/DAO/implementationKeychainDAO_Session.php';
    require_once 'Model/Service/implementationBorrowService.php';

    $controller = new LoseKeychainController();

    header('location:?/');
}

// Prolonger un trousseau
dispatch('/extendBorrowingForm/:id', 'extendBorrowingForm');
function extendBorrowingForm($id){
    require_once 'Controller/extendBorrowingFormController.php';
    require_once 'Model/DAO/implementationKeychainDAO_Session.php';
    require_once 'Model/Service/implementationBorrowService.php';

    $controller = new extendBorrowingFormController("Emprunt", $id);
    //Appel de la vue
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/extendBorrowingForm.php';
    require 'View/Partial/footer.php';
}

// Prolonger un trousseau (post)
dispatch_post('/extendBorrowing', 'extendBorrowing');
function extendBorrowing(){
    require_once 'Controller/extendBorrowingController.php';
    require_once 'Model/DAO/implementationUserDAO_Session.php';
    require_once 'Model/DAO/implementationKeychainDAO_Session.php';
    require_once 'Model/Service/implementationBorrowService.php';

    $controller = new extendBorrowingController();

    header('location:?/');
}

//Emprunts - Formulaire (dispatch_post)
dispatch_post('/borrowKeychain', 'borrowKeychain');
function borrowKeychain(){
    require_once 'Controller/BorrowKeychainController.php';
    require_once 'Model/DAO/implementationUserDAO_Session.php';
    require_once 'Model/DAO/implementationKeychainDAO_Session.php';
    require_once 'Model/Service/implementationBorrowService.php';
    require_once 'Model/Service/implementationKeyService.php';
    require_once 'Model/Service/implementationKeychainService.php';

    $controller = new BorrowKeychainController();

    header('location:?/borrowKeychainForm');
}

//Traitement du formulaire CSV
dispatch_post('/uploadKeychainCSV', 'uploadKeychainCSV');
function uploadKeychainCSV(){
    require_once 'Model/Service/implementationKeychainService.php';
    require_once 'Controller/UploadKeychainCSVController.php';
    require_once 'Model/DAO/implementationKeychainDAO_Session.php';

    $controller = new uploadKeychainCSVController();

    header('location:?/BorrowKeychainForm');
}

//Traitement du formulaire CSV
dispatch_post('/uploadKeyCSV', 'uploadKeyCSV');
function uploadKeyCSV(){
    require_once 'Model/Service/implementationKeyService.php';
    require_once 'Controller/UploadKeyCSVController.php';
    require_once 'Model/DAO/implementationKeyDAO_Session.php';

    $controller = new UploadKeyCSVController();

    header('location:?/keys');
}

dispatch('/doors', 'doors');
function doors(){
    //Import des classes
    require_once 'Model/DAO/implementationDoorDAO_Session.php';
    require_once 'Controller/DoorsController.php';
    //Appel du controlleur
    $controller = new DoorsController("Doors");
    //Appel de la vue
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/doors.php';
    require 'View/Partial/footer.php';
}

dispatch('/createDoorForm', 'createDoorFrom');
function createDoorFrom(){
    //Import des classes
    require_once 'Model/DAO/implementationDoorDAO_Session.php';
    require_once 'Model/VO/DoorVO.php';
    require_once 'Controller/CreateDoorFormController.php';
    require_once 'Model/DAO/implementationRoomDAO_Session.php';

    //Appel du controlleur
    $controller = new CreateDoorFormController("Doors");
    //Appel de la vue
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/createDoorForm.php';
    require 'View/Partial/footer.php';
}


dispatch_post('/createDoor/', 'createDoor');
function createDoor(){
    //Import des classes
    require_once 'Model/Service/implementationDoorService.php';
    require_once 'Model/DAO/implementationDoorDAO_Session.php';
    require_once 'Model/VO/DoorVO.php';
    require_once 'Controller/CreateDoorController.php';
    //Appel du controlleur
    $controller = new CreateDoorController("Doors");

    header('location:?/doors');
}

dispatch('/locks', 'locks');
function locks(){
    require_once 'Model/DAO/implementationLockDAO_Session.php';
    require_once 'Model/Service/implementationLockService.php';
    require_once 'Model/DAO/implementationDoorDAO_Session.php';
    require_once 'Controller/LocksController.php';

    $controller = new LocksController("Locks");

    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/locks.php';
    require 'View/Partial/footer.php';
}
//Salles
dispatch('/rooms', 'rooms');
function rooms(){
    require_once 'Model/DAO/implementationRoomDAO_Session.php';
    require_once 'Model/Service/implementationRoomService.php';
    require_once 'Model/DAO/implementationDoorDAO_Session.php';
    require_once 'Model/DAO/implementationLockDAO_Session.php';
    require_once 'Model/DAO/implementationKeyDAO_Session.php';
    require_once 'Controller/RoomController.php';

    $controller = new RoomController("Salles");
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/rooms.php';
    require 'View/Partial/footer.php';
}
//Salles - Formulaire (dispatch_post)
dispatch_post('/rooms', 'roomsForm');
function roomsForm(){
    require_once 'Model/DAO/implementationRoomDAO_Session.php';
    require_once 'Model/Service/implementationRoomService.php';
    require_once 'Controller/CreateRoomController.php';

    $controller = new CreateRoomController("Salles");
    header('location:?/rooms');
}

//Traitement du formulaire CSV
dispatch_post('/uploadRoomCSV', 'uploadRoomCSV');
function uploadRoomCSV(){
    require_once 'Model/Service/implementationRoomService.php';
    require_once 'Controller/UploadRoomCSVController.php';
    require_once 'Model/DAO/implementationRoomDAO_Session.php';

    $controller = new UploadRoomCSVController();

    header('location:?/rooms');
}

dispatch('/providers', 'providers');
function providers(){
    //Import des classes
    require_once 'Model/DAO/implementationFournisseurDAO_Session.php';
    require_once 'Model/VO/ProviderVO.php';
    require_once 'Model/Service/implementationFournisseurService.php';
    require_once 'Controller/FournisseurController.php';
    //Appel du controlleur
    $controller = new FournisseurController("Providers");
    //Appel de la vue
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/providers.php';
    require 'View/Partial/footer.php';
}

//Demarrage de Limonade
run();

?>
