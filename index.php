<?php
session_start();
require_once 'Libs/limonade/limonade.php';

//dispatch_post('/', 'home'); POUR LE POST

dispatch('/', 'home');
function home(){
    //Import des classes
    require_once 'Model/DAO/implementationKeychainDAO_Dummy.php';
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

//Demarrage de Limonade
run();

?>
