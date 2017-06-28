<?php

require_once 'Model/Service/interfaceDoorService.php';
require_once 'Model/DAO/implementationDoorDAO_Session.php';

class implementationDoorService implements interfaceDoorService
{
    /**
     * @var Singleton
     * @access private
     * @static
     */
    private static $_instance = null;

    private $_doors = array(); // doorId
    private $_doorDAO;

    /**
     * Constructeur de la classe
     *
     * @param void
     * @return void
     */
    private function __construct()
    {
        $factory = getDAOFactory();
        $this->_doorDAO = $factory->getDoorDAO();
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
            self::$_instance = new implementationDoorService();
        }

        return self::$_instance;
    }

    //Créaction de porte
    public function createDoor($room)
    {
        $door = new DoorVO();
        $door->setRoomId($room);
        $this->_doorDAO->addDoor($door);

        return $door;
    }
}

?>
