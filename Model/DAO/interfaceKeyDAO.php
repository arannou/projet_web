<?php

interface interfaceKeyDAO
{
  public function populate();
  public static function getInstance();
  public function getKeys();
  public function getKeyById($idKey);
  public function getKeychainOfKey($keychainId, $keyId);
  public function addKey($key);
  public function updateKey($updatedKey);
}

?>
