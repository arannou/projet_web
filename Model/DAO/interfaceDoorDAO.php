<?php

interface interfaceDoorDAO
{

    public static function getInstance();

    public function getIdRoom();
    public function getId();
	public function getIdLock();
	
	public function setIdRoom();
	public function setId();
	public function setIdLock();

	public function delete();
	
	public function changeLock();
}

?>
