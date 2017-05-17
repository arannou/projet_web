<?php
require_once 'Model/VO/RoomVO.php';
require_once 'Model/DAO/interfaceRoomDAO.php';

class implementationRoomDAO_Session implements interfaceRoomDAO
{

  private $_rooms = array();

  /**
   * @var Singleton
   * @access private
   * @static
   */
   private static $_instance = null;


   /**
    * Constructeur de la classe
    *
    * @param void
    * @return void
    */
   private function __construct() {
     if (file_exists(dirname(__FILE__).'/rooms.xml')) {
       $rooms = simplexml_load_file(dirname(__FILE__).'/rooms.xml');
       foreach($rooms->children() as $xmlroom)
       {
         $room = new roomVO();
         $room->setId($xmlroom->roomId);
         $this->addRoom($room);
       }
     } else {
         throw new RuntimeException('Echec lors de l\'ouverture du fichier rooms.xml.');
     }

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
       self::$_instance = new implementationRoomDAO_Session();
     }

     return self::$_instance;
   }

   public function getRooms()
   {
     return $_SESSION["rooms"];
   }

   public function getRoomById($id)
   {
     foreach ($this->getRooms() as $key => $room) {
         if($room['roomId'] == $id){
             return $room;
         }
     }
     return null;
   }
   public function addRoom($room)
   {
     # créer un tableau dans lequel on met toutes les infos de la room
     $_SESSION['rooms'][] = $room;
   }
}


?>
