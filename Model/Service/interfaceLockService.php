<?php

interface interfaceLockService
{
    public function createLock($length, $provider, $doorId);
    public function deleteLock($id);
}

?>
