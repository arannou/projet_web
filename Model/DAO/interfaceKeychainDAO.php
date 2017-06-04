<?php

interface interfaceKeyChainDAO
{

    // Singleton
    public function populate();
    
    public static function getInstance();

    public function getKeychains();

    public function getRandomKeychain();

}

?>
