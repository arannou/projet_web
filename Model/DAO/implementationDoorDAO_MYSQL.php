<?php
require_once 'Model/VO/DoorVO.php';
require_once 'Model/DAO/interfaceDoorDAO.php';
require_once 'Model/DAO/ImplementationDAO_MYSQL.php';


// Implémentation de l'interface
class implementationDoorDAO_MYSQL extends ImplementationDAO_MYSQL implements interfaceDoorDAO
{

	private $_tableName = "door";

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
	private function __construct()
	{
		parent::initDb();
	}

	public function populate()
	{
		if (file_exists(dirname(__FILE__) . '/doors.xml')) {
			$doors = simplexml_load_file(dirname(__FILE__) . '/doors.xml');
			foreach ($doors->children() as $xmlDoor) {
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
	public static function getInstance()
	{

		if (is_null(self::$_instance)) {
			self::$_instance = new implementationDoorDAO_MYSQL();
		}

		return self::$_instance;
	}

	public function getDoors()
	{
		$stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName");
		$stmt->execute();

		$doors = [];
		$door = new DoorVO;

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$door->setId($row["id"]);
			$door->setRoomId($row["roomId"]);

			array_push($doors, $door);
		}

		return $doors;
	}

	public function getDoorById($id)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE id = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		$door = new DoorVO;

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$door->setId($row["id"]);
		$door->setLockId($row["lockId"]);
		$door->setRoomId($row["roomId"]);

		return $door;
	}

	public function addDoor($door)
	{
		$stmt = $this->pdo->prepare("INSERT INTO $this->_tableName
			(roomId)
			VALUES (:roomId)");

		$roomId = $door->getRoomId();

		$stmt->bindParam(':roomId', $roomId);

		$stmt->execute();
	}

	public function getDoorByRoomId($idRoom)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE roomId = :idRoom");
		$stmt->bindParam(':idRoom', $idRoom);
		$stmt->execute();

		$doors = [];
		$door = new DoorVO;

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$door->setId($row["id"]);
			$door->setLockId($row["lockId"]);
			$door->setRoomId($row["roomId"]);

			array_push($doors, $door);
		}

		return $doors;
	}
}
