<?php

interface interfaceFournisseurDAO
{

    // Singleton
    public static function getInstance();

    /**
     * Retourne tout les fournisseurs
     *
     * @return mixed
     */
    public function getProviders();

    /**
     * Retourne le fournisseur dont l'id est donné
     *
     * @param $id
     * @return mixed
     */
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
