<?php

interface interfaceKeyChainDAO
{

    // Singleton
    public function populate();

    public static function getInstance();

    /**
     * Ajoute un trousseau
     *
     * @param $keychain
     * @return mixed
     */
    public function addKeychain($keychain);

    /**
     * Retourne tous les trousseaux
     *
     * @return mixed
     */
    public function getKeychains();

    /**
     * Retourne le trousseau dont l'id est donné
     *
     * @param $keychainId
     * @return mixed
     */
    public function getKeychainById($keychainId);

}

?>
