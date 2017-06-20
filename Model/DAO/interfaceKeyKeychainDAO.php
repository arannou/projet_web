<?php

interface interfaceKeyKeychainDAO
{
    public static function getInstance();

    public function getKeysByKeychainId($keychainId);

}

?>
