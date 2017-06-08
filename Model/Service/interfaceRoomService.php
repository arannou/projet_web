<?php


interface interfaceRoomService
{
  public static function getInstance();
  public function createRoom($id);
  public function addDoorToRoom();
  public function deleteDoorToRoom();
}
?>
