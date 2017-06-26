<?php

interface interfaceDoorDAO
{

  public function populate();
  public static function getInstance();

  /**
   * Retoune toutes les portes
   *
   * @return mixed
   */
  public function getDoors();


  /**
   * Ajoute une porte
   *
   * @param $room
   * @return mixed
   */
  public function addDoor($room);

  /**
   * Retourne la porte dont l'id est donné en parametre
   *
   * @param $id
   * @return mixed
   */
  public function getDoorById($id);

  /**
   * Retourne les portes attachées à une salle donnée
   *
   * @param $idRoom
   * @return mixed
   */
  public function getDoorByRoomId($idRoom);
}

?>
