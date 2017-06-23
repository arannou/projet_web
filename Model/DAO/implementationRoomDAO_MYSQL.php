<?php
require_once 'Model/VO/RoomVO.php';
require_once 'Model/DAO/interfaceRoomDAO.php';

class implementationRoomDAO_MYSQL extends ImplementationDAO_MYSQL implements interfaceRoomDAO{

  private static $_instance = null;
  private $_tableName = "room";

  private function __construct() {
    parent::initDb();
  }

   public function populate() {
       if (file_exists(dirname(__FILE__).'/rooms.xml')) {
         $rooms = simplexml_load_file(dirname(__FILE__).'/rooms.xml');
         foreach($rooms->children() as $xmlroom)
         {
           $room = new roomVO();
           $room->setId((string)$xmlroom->roomId);
           $this->addRoom($room);
         }
       } else {
           throw new RuntimeException('Echec lors de l\'ouverture du fichier rooms.xml.');
       }
   }

  public static function getInstance() {
    if(is_null(self::$_instance)) {
      self::$_instance = new implementationRoomDAO_MYSQL();
    }
    return self::$_instance;
  }

   public function getRooms(){
     $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName");
     $stmt->execute();

     $rooms = [];

     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
       $room = new RoomVO();
       $room->setRoomId($row["name"]);

       array_push($rooms, $room);
     }
     return $rooms;
   }

   public function getRoomById($id){
     $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE name = :id");
     $stmt->bindParam(':name', $id);
     $stmt->execute();

     $rooms = [];

     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $room = new RoomVO();
        $room->setRoomId($row["name"]);

        array_push($rooms, $room);
    }
    return $rooms;
  }

   public function getRoomByIdCSV($id){
     foreach ($this->getRooms() as $key => $room) {
      if($id == $room->getId()) {
        return $room;
      }
     }
     return null;
   }

   public function addRoom($room){
     $stmt = $this->pdo->prepare("INSERT INTO $this->_tableName (name) VALUES (:name)");
     
     $name =  $room->getId();

     $stmt->bindParam(':name', $name);

     $stmt->execute();
   }
}

?>
