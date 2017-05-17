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
     if (file_exists(dirname(__FILE__).'/doors.xml')) {
       $doors = simplexml_load_file(dirname(__FILE__).'/doors.xml');
       foreach($doors->children() as $xmlDoor)
       {
         $door = new DoorVO;
         $door->setId((int) $xmlDoor->id);
		 $door->setIdRoom((int) $xmlDoor->idRoom);
		 $door->setIdLock((int) $xmlDoor->idLock);


         array_push($this->_doors,$door);
		 array_push($_SESSION['doors'],array((string)($xmlDoor->id) => array(
			 "room"=>(int) $xmlDoor->idRoom,
			 "lock"=>(int) $xmlDoor->idLock)));
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

    public function getIdRoom() {
		return $this->idRoom;
	}
    public function getId() {
		return $this->id;
	}
	public function getIdLock() {
		return $this->idLock;
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

	public function add($idRoom, $idLock) {
		array_push($_SESSION['doors'], array((string)(getLastId()) => array(
			 "room"=>$idRoom,
			 "lock"=>$idLock)));
       
	}

	public function getDoors() {
		return $this->_doors;
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
