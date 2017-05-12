<?php
session_start();
require_once 'Libs/limonade/limonade.php';

//dispatch_post('/', 'home'); POUR LE POST

dispatch('/', 'home');
function home(){
    require_once 'Model/DAO/implementationKeychainDAO_Dummy.php';
    require_once 'Model/DAO/implementationUserDAO_Dummy.php';
    require_once 'Model/VO/KeychainVO.php';
    require_once 'Model/Service/implementationBorrowService_Dummy.php';
    require_once 'Controller/HomeController.php';

    $controller = new HomeController("Home");

    require 'View/home.php';
}

dispatch('/users', 'users');
function users(){
    require_once 'Model/DAO/implementationUserDAO_Dummy.php';
    require_once 'Model/VO/UserVO.php';
    require_once 'Controller/UsersController.php';

    $controller = new UsersController("Users");

    require 'View/users.php';
}

run();

?>
