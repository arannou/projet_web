<?php

interface interfaceKeyChainDAO
{

    // Singleton
    public function populate();

    public static function getInstance();

    public function addKeychain($keychain);

    public function getKeychains();

    public function getKeychainById($keychainId);

}

?>
