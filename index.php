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

    require_once 'Model/DAO/implementationDoorDAO_Dummy.php';
    $doorDAO = implementationDoorDAO_Dummy::getInstance();
    $doorDAO->populate();

    require_once 'Model/DAO/implementationKeychainDAO_Dummy.php';
    $keyChainDAO = implementationKeychainDAO_Dummy::getInstance();
    $keyChainDAO->populate();

    require_once 'Model/DAO/implementationKeyDAO_Dummy.php';
    $keyDAO = implementationKeyDAO_Dummy::getInstance();
    $keyDAO->populate();

    require_once 'Model/DAO/implementationLockDAO_Session.php';
    $lockDAO = implementationLockDAO_Session::getInstance();
    $lockDAO->populate();

    require_once 'Model/DAO/implementationRoomDAO_Session.php';
    $roomDAO = implementationRoomDAO_Session::getInstance();
    $roomDAO->populate();

    require_once 'Model/DAO/implementationUserDAO_Dummy.php';
    $userDAO = implementationUserDAO_Dummy::getInstance();
    $userDAO->populate();

    var_dump($_SESSION);
}

dispatch('/dumpDatabase', 'dumpDatabase');
function dumpDatabase(){
    require_once 'Model/VO/KeychainVO.php';
    require_once 'Model/Service/implementationBorrowService_Dummy.php';
    require_once 'Controller/HomeController.php';
    //Appel du controlleur
    $controller = new HomeController("Home");
    //Appel de la vue
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/home.php';
    require 'View/Partial/footer.php';
}

//Page home
dispatch('/', 'home');
function home(){
  //Import des classes
  require_once 'Model/DAO/implementationKeychainDAO_Dummy.php';
  require_once 'Model/DAO/implementationBorrowingsDAO_Session.php';
  require_once 'Model/DAO/implementationUserDAO_Dummy.php';
  require_once 'Model/Service/implementationBorrowService_Dummy.php';
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
dispatch('/users', 'users');
function users(){
  //Import des classes
  require_once 'Model/DAO/implementationUserDAO_Dummy.php';
  require_once 'Controller/UsersController.php';
  //Appel du controlleur
  $controller = new UsersController("Users");
  //Appel de la vue
  require 'View/Partial/head.php';
  require 'View/Partial/nav.php';
  require 'View/users.php';
  require 'View/Partial/footer.php';
}

dispatch('/keys', 'keys');
function keys(){
    //Import des classes
    require_once 'Model/DAO/implementationKeyDAO_Dummy.php';
    require_once 'Controller/KeysController.php';
    //Appel du controlleur
    $controller = new KeysController("Keys");
    //Appel de la vue
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/keys.php';
    require 'View/Partial/footer.php';
}

//Emprunt
dispatch('/borrowKeychainForm', 'borrowKeychainForm');
function borrowKeychainForm(){
  //Import des classes
  require_once 'Model/DAO/implementationKeychainDAO_Dummy.php';
  require_once 'Model/DAO/implementationUserDAO_Dummy.php';
  require_once 'Model/Service/implementationBorrowService_Dummy.php';
  require_once 'Controller/BorrowKeyChainFormController.php';
  //Appel du controller
  $controller = new BorrowKeyChainFormController("Emprunt");
  //Appel de la vue
  require 'View/Partial/head.php';
  require 'View/Partial/nav.php';
  require 'View/borrowKeychainForm.php';
  require 'View/Partial/footer.php';
}

//Emprunts - Formulaire (dispatch_post)
dispatch_post('/borrowKeychain', 'borrowKeychain');
function borrowKeychain(){
  require_once 'Controller/BorrowKeychainController.php';
  require_once 'Model/DAO/implementationUserDAO_Dummy.php';
  require_once 'Model/DAO/implementationKeychainDAO_Dummy.php';
  require_once 'Model/Service/implementationBorrowService_Dummy.php';

  $controller = new BorrowKeychainController();

  header('location:?/borrowKeychainForm');
}

dispatch('/doors', 'doors');
function doors(){
    //Import des classes
    require_once 'Model/DAO/implementationDoorDAO_Dummy.php';
    require_once 'Controller/DoorsController.php';
    //Appel du controlleur
    $controller = new DoorsController("Doors");
    //Appel de la vue
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/doors.php';
    require 'View/Partial/footer.php';
}

dispatch('/locks', 'locks');
function locks(){
  require_once 'Model/DAO/implementationLockDAO_Session.php';
  require_once 'Model/Service/implementationLockService.php';
  require_once 'Controller/LocksController.php';

  $controller = new LocksController("Locks");

  require 'View/Partial/head.php';
  require 'View/Partial/nav.php';
  require 'View/locks.php';
}
//Salles
dispatch('/rooms', 'rooms');
function rooms(){
  require_once 'Model/DAO/implementationRoomDAO_Session.php';
  require_once 'Model/Service/implementationRoomService.php';
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
  //header('location:?/rooms');
}

dispatch('/providers', 'providers');
function providers(){
    //Import des classes
    require_once 'Model/DAO/implementationFournisseurDAO_Session.php';
    require_once 'Model/VO/ProviderVO.php';
    require_once 'Model/Service/implementationFournisseurService_Dummy.php';
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
