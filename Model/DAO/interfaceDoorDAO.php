<?php

interface interfaceDoorDAO
{

  public function populate();
  public static function getInstance();

  public function getDoors();

  public function addDoor($room);
}

?>
