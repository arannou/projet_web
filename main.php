<?php
//require 'Personnage.php'; // J'inclus la classe.

/**********************
//Autoload
function chargerClasse($classe)
{
  require $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
}
spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
/******************************/


//$perso = new Personnage(30,20);
//$perso->parler();

require_once 'Model/DAO/implementationUserDAO_Session.php';
require_once 'Model/DAO/implementationKeychainDAO_Session.php';
require_once 'Model/Service/implementationBorrowService.php';
require_once 'Model/Service/interfaceBorrowService.php';
require_once 'Model/DAO/interfaceUserDAO.php';

$borrowService = implementationBorrowService::getInstance();
//print_r($borrowService->getBorrowings());


$userDAO = implementationUserDAO_Session::getInstance();
$keychainDAO = implementationKeychainDAO_Session::getInstance();

$users = $userDAO->getUsers();
$keychains = $keychainDAO->getKeychains();

$tDate = new DateTime;
$tDate->setTimestamp(time());
$tDate->modify('+10 day');

$borrowService->borrowKeychain($users[0]->getEnssatPrimaryKey(),$keychains[0]->getId(),$tDate);

//print_r($borrowService->getBorrowings());

echo "1 : ".$borrowService->getBorrowingStatus(1)."\n";
echo "2 : ".$borrowService->getBorrowingStatus(2)."\n";
echo "3 : ".$borrowService->getBorrowingStatus(3)."\n";
echo "4 : ".$borrowService->getBorrowingStatus(4)."\n";
echo "5 : ".$borrowService->getBorrowingStatus(5)."\n";
echo "6 : ".$borrowService->getBorrowingStatus(6)."\n";
echo "7 : ".$borrowService->getBorrowingStatus(7)."\n";
echo "8 : ".$borrowService->getBorrowingStatus(8)."\n";



$borrowService->returnKeychain(1,"tout est ok");
$borrowService->lostKeychain(2,"poil au nez\n");

echo "1 : ".$borrowService->getBorrowingStatus(1)."\n";
echo "2 : ".$borrowService->getBorrowingStatus(2)."\n";
echo "3 : ".$borrowService->getBorrowingStatus(3)."\n";
echo "4 : ".$borrowService->getBorrowingStatus(4)."\n";
echo "5 : ".$borrowService->getBorrowingStatus(5)."\n";
echo "6 : ".$borrowService->getBorrowingStatus(6)."\n";
echo "7 : ".$borrowService->getBorrowingStatus(7)."\n";
echo "8 : ".$borrowService->getBorrowingStatus(8)."\n";


$borrowService->returnKeychain(2,"tout est ok");

echo "1 : ".$borrowService->getBorrowingStatus(1)."\n";
echo "2 : ".$borrowService->getBorrowingStatus(2)."\n";
echo "3 : ".$borrowService->getBorrowingStatus(3)."\n";
echo "4 : ".$borrowService->getBorrowingStatus(4)."\n";
echo "5 : ".$borrowService->getBorrowingStatus(5)."\n";
echo "6 : ".$borrowService->getBorrowingStatus(6)."\n";
echo "7 : ".$borrowService->getBorrowingStatus(7)."\n";
echo "8 : ".$borrowService->getBorrowingStatus(8)."\n";


$borrowService->returnKeychain(8,"tout est ok");

?>
