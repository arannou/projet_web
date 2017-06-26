<?php

interface interfaceKeyKeychainDAO
{
    public static function getInstance();


    /**
     * Retourne les clés qui compose le trousseau
     *
     * @param $keychainId
     * @return mixed
     */
    public function getKeysByKeychainId($keychainId);

}

?>
