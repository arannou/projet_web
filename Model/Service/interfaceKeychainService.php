<?php

interface interfaceKeychainService
{
    public function createKeychain($creationDate, $dueDate, $keys);

    public function createKeychainFromCSV($keychainId, $creationDate, $dueDate, $keys);

    public function checkKeychainById($keychainId);
}

?>
