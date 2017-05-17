<?php
session_start();
require_once 'Libs/limonade/limonade.php';

if(!isset($_SESSION['borrowings'])){
  $_SESSION['borrowings'] = [];
}


if(!isset($_SESSION['locks'])){
    $_SESSION['locks'] = [];
}

if(!isset($_SESSION['rooms'])){
  $_SESSION['rooms'] = [];
}

//Page home

dispatch('/', 'home');
function home(){
  //Import des classes
  require_once 'Model/DAO/implementationKeychainDAO_Dummy.php';
  require_once 'Model/DAO/implementationBorrowingsDAO_Session.php';
  require_once 'Model/DAO/implementationUserDAO_Dummy.php';
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

//Utilisateurs
dispatch('/users', 'users');
function users(){
  //Import des classes
  require_once 'Model/DAO/implementationUserDAO_Dummy.php';
  require_once 'Model/VO/UserVO.php';
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
    require_once 'Model/VO/KeyVO.php';
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
  require_once 'Model/DAO/implementationKeychainDAO_Dummy.php';
  require_once 'Model/DAO/implementationUserDAO_Dummy.php';
  require_once 'Model/VO/KeychainVO.php';
  require_once 'Model/Service/implementationBorrowService_Dummy.php';
  require_once 'Controller/BorrowKeyChainFormController.php';

  $controller = new BorrowKeyChainFormController("Emprunt");
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
    require_once 'Model/VO/DoorVO.php';
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
  require_once 'Model/VO/LockVO.php';
  require_once 'Model/Service/implementationLockService.php';
  require_once 'Controller/LocksController.php';

  $controller = new LocksController("Locks");

  require 'View/Partial/head.php';
  require 'View/Partial/nav.php';
  require 'View/locks.php';

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


//Demarrage de Limonade
run();

?>
