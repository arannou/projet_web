<?php
require_once 'Model/Service/interfaceRoomService.php';
require_once 'Model/DAO/implementationRoomDAO_Session.php';
class implementationRoomService implements interfaceRoomService
{
  /**
   * @var Singleton
   * @access private
   * @static
   */
   private static $_instance = null;
   private $_rooms = array(); // roomId
   private $_roomDAO;
   /**
   * Constructeur de la classe
   *
   * @param void
   * @return void
   */
   private function __construct()
   {
     $this->_roomDAO = implementationRoomDAO_Session::getInstance();
   }
   /**
    * Méthode qui crée l'unique instance de la classe
    * si elle n'existe pas encore puis la retourne.
    *
    * @param void
    * @return Singleton
    */
   public static function getInstance() {
     if(is_null(self::$_instance)) {
       self::$_instance = new implementationRoomService();
   }

     return self::$_instance;
   }
   public function createRoom($id) {
     $room = new RoomVO();
     $room->setId($id);
     $this->_roomDAO->addRoom($room);
   }
   
   public function addDoorToRoom() {
   }
   public function deleteDoorToRoom() {
   }
}
?>
