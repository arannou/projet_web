<?php


interface interfaceFournisseurService
{
  public static function getInstance();
  public function getProviderById($providerId);
  public function getProviders();

}
?>
