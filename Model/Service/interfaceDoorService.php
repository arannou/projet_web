<?php


interface interfaceDoorService
{
  public static function getInstance();
  public function createDoor($room, $lock);
  public function addLockToDoor();
  public function deleteLockToDoor();

}



?>
