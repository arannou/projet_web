<?php

interface interfaceKeyService
{
  public static function getInstance();
  public function createKeyFromCSV($id, $type);
  public function checkKeyByIdKey($idKey);
}

?>
