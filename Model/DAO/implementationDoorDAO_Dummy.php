<?php
require_once 'Model/VO/DoorVO.php';
require_once 'Model/DAO/interfaceDoorDAO.php';



// Implémentation de l'interface
class implementationDoorDAO_Dummy implements interfaceDoorDAO
{

	private $doors = array();
	private $idRoom;
	private $id;
	private $idLock;
	private $lastId = 2;

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
	 /*$_SESSION['doors'] = array();
     if (file_exists(dirname(__FILE__).'/doors.xml')) {
       $doors = simplexml_load_file(dirname(__FILE__).'/doors.xml');
       foreach($doors->children() as $xmlDoor)
       {
		 $this->add((int) $xmlDoor->idroom,(int) $xmlDoor->idlock,$xmlDoor->id);
       }
     } else {
         throw new RuntimeException('Echec lors de l\'ouverture du fichier doors.xml.');
     }*/

   }

   public function populate(){
	   $_SESSION['doors'] = array();
       if (file_exists(dirname(__FILE__).'/doors.xml')) {
         $doors = simplexml_load_file(dirname(__FILE__).'/doors.xml');
         foreach($doors->children() as $xmlDoor)
         {
  		 $this->add((int) $xmlDoor->idroom,(int) $xmlDoor->idlock,(string)$xmlDoor->id);
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

    public function getIdRoom($id) {
		return $_SESSION["doors"][$id]["room"];;
	}
    public function getId() {
		return $this->id;
	}
	public function getIdLock($id) {
		return $_SESSION["doors"][$id]["lock"];;
	}

	public function setIdRoom($id) {
		$this->idRoom = $id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function setIdLock($id) {
		$this->idLock = $id;
	}

	public function add($idRoom, $idLock, $id=null) {
		if ($id == null) $id= getLastId();
		$_SESSION['doors']["$id"] = array(
			 "room"=>$idRoom,
			 "lock"=>$idLock);
	}

	public function getDoors() {
		return $_SESSION["doors"];
	}
	public function getLastDoorId() {
		$this->$lastId = $this->$lastId+1;
		return $this->$lastId;
	}
	public function delete($id) {
		unset($_SESSION['doors'][$id]);
	}

}


?>
