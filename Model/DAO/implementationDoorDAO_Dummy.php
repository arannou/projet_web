<?php
require_once 'Model/VO/DoorVO.php';
require_once 'Model/DAO/interfaceDoorDAO.php';

// Implémentation de l'interface
class implementationDoorDAO_Dummy implements interfaceDoorDAO
{

	private $doors = array();

  /**
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

   }

   public function populate(){
	   $_SESSION['doors'] = array();
       if (file_exists(dirname(__FILE__).'/doors.xml')) {
         $doors = simplexml_load_file(dirname(__FILE__).'/doors.xml');
         foreach($doors->children() as $xmlDoor)
         {
			 $door = new DoorVO();
			 $door->setId((int)$xmlDoor->id);
			 $door->setRoomId((string)$xmlDoor->idRoom);
  		 	 $this->addDoor($door);
         }
       } else {
           throw new RuntimeException('Echec lors de l\'ouverture du fichier doors.xml.');
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
       self::$_instance = new implementationDoorDAO_Dummy();
     }

     return self::$_instance;
   }

	public function getDoors() {
		return $_SESSION["doors"];
	}

	public function getDoorById($id){
		$doors = $this->getDoors();

		foreach ($doors as $key => $door) {
			if($door->getId() == $id){
				return $door;
			}
		}

		return null;
	}

	public function addDoor($door) {
		array_push($_SESSION['doors'], $door);
	}
}


?>
