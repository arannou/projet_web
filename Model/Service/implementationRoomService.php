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
        $factory = getDAOFactory();

        $this->_roomDAO = $factory->getRoomDAO();
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

    //Créaction de salle
    public function createRoom($id) {
        $room = new RoomVO();
        $room->setId($id);
        $this->_roomDAO->addRoom($room);
    }

    //Création de salle à l'aide d'un CSV
    public function createRoomFromCSV($id) {
        if(!$this->checkRoomById($id)) {
            $room = new RoomVO();
            $room->setId($id);
            $this->_roomDAO->addRoom($room);
        }
    }

    //Vérification de l'existance ou non d'une salle à l'aide d'un identifiant
    public function checkRoomById($id) {
      if ($this->_roomDAO->getRoomByIdCSV($id) != null) {
          return true;
      }
      else {
          return false;
      }
    }
}
?>
