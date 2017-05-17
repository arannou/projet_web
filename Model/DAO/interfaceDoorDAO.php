<?php

interface interfaceDoorDAO
{

    public static function getInstance();

    public function getIdRoom($id);
    public function getId();
	public function getIdLock($id);
	
	public function setIdRoom($id);
	public function setId($id);
	public function setIdLock($id);

	public function delete($id);
	public function getDoors();
	public function getLastDoorId();
	
	public function add($idRoomm, $idLock, $id=null);
}

?>
