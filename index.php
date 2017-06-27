<?php

//Import des classes pour l'accès à la BDD
require_once 'db.conf.php';
require_once 'Model/DAO/MysqlDbConnection.php';

require_once 'Model/Factory/DAOFactory_Session.php';
require_once 'Model/Factory/DAOFactory_MYSQL.php';
require_once 'Model/Factory/FactoryProvider.php';

// Recupère la factory correspond au mode de persistance
function getDAOFactory(){
    $provider = new FactoryProvider(FactoryProvider::$FACTORY_MYSQL);
    $factory = $provider->getFactory();
    return $factory;
}

// Import des VO
require_once 'Model/VO/KeychainVO.php';
require_once 'Model/VO/UserVO.php';
require_once 'Model/VO/KeyVO.php';
require_once 'Model/VO/DoorVO.php';
require_once 'Model/VO/RoomVO.php';
require_once 'Model/VO/LockVO.php';
require_once 'Model/VO/ProviderVO.php';

// Démarrage de la session
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

// Fonction qui permet de supprimer les données stockées en session
dispatch('/clearsession', 'clearsession');
function clearsession() {
    session_destroy();
    session_start();
}

// Fonction qui permet d'ajouter les données dans la session
dispatch('/populateDatabase', 'populateDatabase');
function populateDatabase(){
    $_SESSION['borrowings'] = array();
    $_SESSION['locks'] = array();
    $_SESSION['rooms'] = array();
    $_SESSION['keys'] = array();
    $_SESSION['keychains'] = array();
    $_SESSION['doors'] = array();
    $_SESSION['users'] = array();

    $factory = getDAOFactory();

    $doorDAO = $factory->getDoorDAO();
    $doorDAO->populate();

    $keyChainDAO = $factory->getKeychainDAO();
    //$keyChainDAO->populate();

    $keyDAO = $factory->getKeyDAO();
    //$keyDAO->populate();

    $lockDAO = $factory->getLockDAO();
    $lockDAO->populate();

    $roomDAO = $factory->getRoomDAO();
    $roomDAO->populate();

    $userDAO = $factory->getUserDAO();
    $userDAO->populate();

    $providerDAO = $factory->getFournisseurDAO();
    $providerDAO->populate();

    //var_dump($_SESSION);
}

// Fonction qui affiche les différentes données stockées dans la session
dispatch('/dumpDatabase', 'dumpDatabase');
function dumpDatabase(){
    var_dump($_SESSION);
}

//Page home
dispatch('/', 'home');
function home(){
    //Import des classes
    require_once 'Model/Service/implementationBorrowService.php';
    require_once 'Controller/HomeController.php';

    //Appel du controlleur
    $controller = new HomeController("Home");

    //Appel des vues
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/home.php';
    require 'View/Partial/footer.php';

}

//Page Utilisateurs
dispatch('/users/', 'users');
function users(){
    //Import des classes
    require_once 'Controller/UsersController.php';
    require_once 'Model/Service/implementationBorrowService.php';
    require_once 'Model/Service/implementationKeyService.php';

    //Appel du controlleur
    $controller = new UsersController("Users");

    //Appel des vues
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/users.php';
    require 'View/Partial/footer.php';
}

//Traitement du formulaire CSV pour l'ajout d'utilisateur
dispatch_post('/uploadUserCSV', 'uploadUserCSV');
function uploadUserCSV(){
    //Import des classes
    require_once 'Model/Service/implementationUserService.php';
    require_once 'Controller/UploadUserCSVController.php';
    require_once 'Model/DAO/implementationUserDAO_Session.php';

    //Appel du controlleur
    $controller = new UploadUserCSVController();

    //Redirection vers la page Utilisateur
    header('location:?/users');
}

//Page Clef
dispatch('/keys', 'keys');
function keys(){
    //Import des classes
    require_once 'Model/Service/implementationKeyService.php';
    require_once 'Controller/KeysController.php';

    //Appel du controlleur
    $controller = new KeysController("Keys");

    //Appel des vues
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/keys.php';
    require 'View/Partial/footer.php';
}

//Traitement du formulaire pour l'ajout d'une clef
dispatch_post('/addKeysForm', 'addKeysForm');
function addKeysForm() {
    //Import des classes
    require_once 'Model/Service/implementationKeyService.php';
    require_once 'Controller/KeyFormController.php';

    //Appel du controlleur
    $controller = new KeyFormController();

    //Redirection vers la page Clef
    header('location:?keys');
}


//Page Emprunt
dispatch('/borrowKeychainForm', 'borrowKeychainForm');
function borrowKeychainForm(){
    //Import des classes
    require_once 'Model/Service/implementationBorrowService.php';
    require_once 'Model/Service/implementationKeyService.php';
    require_once 'Controller/BorrowKeyChainFormController.php';

    //Appel du controlleur
    $controller = new BorrowKeyChainFormController("Emprunt");

    //Appel des vues
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/borrowKeychainForm.php';
    require 'View/Partial/footer.php';
}

// Affichage des trousseaus perdus sur la page home
dispatch('/loseKeychainForm/:id', 'loseKeychainForm');
function loseKeychainForm($id){
    //Import des classes
    require_once 'Controller/LoseKeychainControllerForm.php';
    require_once 'Model/Service/implementationBorrowService.php';

    //Appel du controlleur
    $controller = new LoseKeychainControllerForm("Emprunt", $id);

    //Appel des vues
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/loseKeychainForm.php';
    require 'View/Partial/footer.php';
}

// Traitement des trousseaus perdus
dispatch_post('/loseKeychain/', 'loseKeychain');
function loseKeychain(){
    //Import des classes
    require_once 'Controller/LoseKeychainController.php';
    require_once 'Model/Service/implementationBorrowService.php';

    //Appel du controlleur
    $controller = new LoseKeychainController();

    //Redirection vers la page home
    header('location:?/');
}

// Prolonger un trousseau
dispatch('/extendBorrowingForm/:id', 'extendBorrowingForm');
function extendBorrowingForm($id){
    //Import des classes
    require_once 'Controller/extendBorrowingFormController.php';
    require_once 'Model/Service/implementationBorrowService.php';

    //Appel du controlleur
    $controller = new extendBorrowingFormController("Emprunt", $id);

    //Appel des vues
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/extendBorrowingForm.php';
    require 'View/Partial/footer.php';
}

// Traitement pour prolonger un trousseau
dispatch_post('/extendBorrowing', 'extendBorrowing');
function extendBorrowing(){
    //Import des classes
    require_once 'Controller/extendBorrowingController.php';
    require_once 'Model/Service/implementationBorrowService.php';

    //Import du controlleur
    $controller = new extendBorrowingController();

    //Redirection vers la page home
    header('location:?/');
}

dispatch('/returnKeychainForm/:id', 'returnKeychainForm');
function returnKeychainForm($id){
    //Import des classes
    require_once 'Model/Service/implementationBorrowService.php';
    require_once 'Controller/ReturnKeychainController.php';

    //Appel du controlleur
    $controller = new ReturnKeychainController($id);

    //Redirection vers la page home
    header('location:?/');
}

//Traitement du formulaire pour la création d'emprunt
dispatch_post('/borrowKeychain', 'borrowKeychain');
function borrowKeychain(){
    //Import des classes
    require_once 'Controller/BorrowKeychainController.php';
    require_once 'Model/Service/implementationBorrowService.php';
    require_once 'Model/Service/implementationKeyService.php';
    require_once 'Model/Service/implementationKeychainService.php';

    //Appel du controlleur
    $controller = new BorrowKeychainController();

    //Redirection vers la page du formulaire d'emprunt de trousseaux
    header('location:?/borrowKeychainForm');
}

//Traitement du formulaire CSV pour l'import de trousseaux
dispatch_post('/uploadKeychainCSV', 'uploadKeychainCSV');
function uploadKeychainCSV(){
    //Import des classes
    require_once 'Model/Service/implementationKeychainService.php';
    require_once 'Controller/UploadKeychainCSVController.php';

    //Appel du controlleur
    $controller = new uploadKeychainCSVController();

    //Redirection vers la page du formulaire d'emprunt de trousseaux
    header('location:?/BorrowKeychainForm');
}

//Traitement du formulaire CSV pour l'import de clefs
dispatch_post('/uploadKeyCSV', 'uploadKeyCSV');
function uploadKeyCSV(){
    //Import des classes
    require_once 'Model/Service/implementationKeyService.php';
    require_once 'Controller/UploadKeyCSVController.php';

    //Appel du controlleur
    $controller = new UploadKeyCSVController();

    //Redirection vers la page clef
    header('location:?/keys');
}

// Page Porte
dispatch('/doors', 'doors');
function doors(){
    //Import d'une class
    require_once 'Controller/DoorsController.php';

    //Appel du controlleur
    $controller = new DoorsController("Doors");

    //Appel des vues
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/doors.php';
    require 'View/Partial/footer.php';
}

// Page de création de porte
dispatch('/createDoorForm', 'createDoorFrom');
function createDoorFrom(){
    //Import des classes
    require_once 'Model/VO/DoorVO.php';
    require_once 'Controller/CreateDoorFormController.php';

    //Appel du controlleur
    $controller = new CreateDoorFormController("Doors");

    //Appel des vues
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/createDoorForm.php';
    require 'View/Partial/footer.php';
}

// Traitement pour la création d'une porte
dispatch_post('/createDoor/', 'createDoor');
function createDoor(){
    //Import des classes
    require_once 'Model/Service/implementationDoorService.php';
    require_once 'Model/VO/DoorVO.php';
    require_once 'Controller/CreateDoorController.php';

    //Appel du controlleur
    $controller = new CreateDoorController("Doors");

    //Redirection vers la page porte
    header('location:?/doors');
}

// Page canon
dispatch('/locks', 'locks');
function locks(){
    //Import des classes
    require_once 'Model/Service/implementationLockService.php';
    require_once 'Model/DAO/implementationDoorDAO_Session.php';
    require_once 'Model/DAO/implementationFournisseurDAO_Session.php';
    require_once 'Controller/LocksController.php';

    //Appel du controlleur
    $controller = new LocksController("Locks");

    //Appel des vues
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/locks.php';
    require 'View/Partial/footer.php';
}

// Traitement du formulaire de création de canons
dispatch_post('/locksForm', 'locksForm');
function locksForm(){
  //Import des classes
  require_once 'Model/Service/implementationLockService.php';
  require_once 'Controller/LocksFormController.php';

  //Appel du controlleur
  $controller = new LocksFormController();

  //Redirection vers la page canon
  header('location:?/locks');
}

// Traitement pour la suppression d'un canon
dispatch_post('/locksSuppr', 'locksSuppr');
function locksSuppr(){
  //Import des classes
  require_once 'Model/Service/implementationLockService.php';
  require_once 'Controller/LocksSupprController.php';

  //Appel du controlleur
  $controller = new LocksSupprController();

  //Redirection vers la page canon
  header('location:?/locks');
}

//Page Salles
dispatch('/rooms', 'rooms');
function rooms(){
    //Import des classes
    require_once 'Model/Service/implementationRoomService.php';
    require_once 'Controller/RoomController.php';

    //Appel du controlleur
    $controller = new RoomController("Salles");

    //Appel des vues
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/rooms.php';
    require 'View/Partial/footer.php';
}
// Traitement du formulaire pour l'ajout d'une salle
dispatch_post('/rooms', 'roomsForm');
function roomsForm(){
    //Import des classes
    require_once 'Model/Service/implementationRoomService.php';
    require_once 'Controller/CreateRoomController.php';

    //Appel du controlleur
    $controller = new CreateRoomController("Salles");

    //Redirection vers la page salle
    header('location:?/rooms');
}

// Traitement du formulaire CSV pour l'import de salle
dispatch_post('/uploadRoomCSV', 'uploadRoomCSV');
function uploadRoomCSV(){
    //Import des classes
    require_once 'Model/Service/implementationRoomService.php';
    require_once 'Controller/UploadRoomCSVController.php';

    //Appel du controlleur
    $controller = new UploadRoomCSVController();

    //Redirection vers la page salle
    header('location:?/rooms');
}

// Page Fournisseur
dispatch('/providers', 'providers');
function providers(){
    //Import des classes
    require_once 'Model/VO/ProviderVO.php';
    require_once 'Model/Service/implementationFournisseurService.php';
    require_once 'Controller/FournisseurController.php';

    //Appel du controlleur
    $controller = new FournisseurController("Providers");

    //Appel des vues
    require 'View/Partial/head.php';
    require 'View/Partial/nav.php';
    require 'View/providers.php';
    require 'View/Partial/footer.php';
}

//Demarrage de Limonade
run();

?>
