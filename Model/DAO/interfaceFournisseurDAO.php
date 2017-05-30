<?php

interface interfaceFournisseurDAO
{

    // Singleton
    public static function getInstance();

    public function getProviders();

    public function getProviderById($id);

    public function getProviderByUsername($username);

    public function getProviderByName($name);

    public function getProviderBySurname($surname);

    public function getProviderByPhone($phone);

    public function getProviderByOffice($office);

    public function getProviderByEmail($email);

    public function addProvider($provider);
}

?>
