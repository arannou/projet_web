<?php

interface interfaceKeyService
{
  public static function getInstance();
  public function createKey($id, $type, $lockId);
  public function checkKeyByIdKey($idKey);
}

?>
