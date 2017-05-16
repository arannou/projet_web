<?php
session_start();
require_once 'Libs/limonade/limonade.php';

//dispatch_post('/', 'home'); POUR LE POST

<<<<<<< Updated upstream
=======
if(!isset($_SESSION['borrowings'])){
    $_SESSION['borrowings'] = [];
}

>>>>>>> Stashed changes
dispatch('/', 'home');
function home(){
    //Import des classes
    require_once 'Model/DAO/implementationKeychainDAO_Dummy.php';
<<<<<<< Updated upstream
=======
    require_once 'Model/DAO/implementationBorrowingsDAO_Session.php';
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
  require 'View/Partial/head.php';
  require 'View/Partial/nav.php';
  require 'View/borrowKeychainForm.php';
  require 'View/Partial/footer.php';
=======
  require 'View/borrowKeychainForm.php';
}

dispatch_post('/borrowKeychain', 'borrowKeychain');
function borrowKeychain(){
    require_once 'Controller/BorrowKeychainController.php';
    require_once 'Model/DAO/implementationUserDAO_Dummy.php';
    require_once 'Model/DAO/implementationKeychainDAO_Dummy.php';
    require_once 'Model/Service/implementationBorrowService_Dummy.php';

    $controller = new BorrowKeychainController();

    //header('location:?/borrowKeychainForm');
>>>>>>> Stashed changes
}

//Demarrage de Limonade
run();

?>
