<?php

interface interfaceUserService
{
  public static function getInstance();
  public function createUserFromCSV($username, $enssatPrimaryKey, $Ur1Identifier, $name, $surname, $phone, $status, $email);
  public function checkUserByEnssatPrimaryKey($enssatPrimaryKey);
}

?>
