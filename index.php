<?php
session_start();
require_once 'Libs/limonade/limonade.php';

dispatch('/', 'home');
function home(){
    require_once 'Model/DAO/implementationKeychainDAO_Dummy.php';
    require_once 'Model/VO/KeychainVO.php';
    require_once 'Controller/HomeController.php';

    $controller = new HomeController("Home");

    require 'View/home.php';
}

run();

?>
