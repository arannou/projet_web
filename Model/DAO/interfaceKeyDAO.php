<?php

interface interfaceKeyDAO
{
  public function populate();
  public static function getInstance();

  /**
   * Retourne toutes les clés
   *
   * @return mixed
   */
  public function getKeys();

  /**
   * Retourne la clé dont l'id est donné
   *
   * @param $idKey
   * @return mixed
   */
  public function getKeyById($idKey);

  /**
   *
   *
   * @param $keychainId
   * @param $keyId
   * @return mixed
   */
  public function getKeychainOfKey($keychainId, $keyId);

  /**
   * Ajoute une clé
   *
   * @param $key
   * @return mixed
   */
  public function addKey($key);

  /**
   * Met a jours les données stockées
   *
   * @param $updatedKey
   * @return mixed7
   */
  public function updateKey($updatedKey);
}

?>
