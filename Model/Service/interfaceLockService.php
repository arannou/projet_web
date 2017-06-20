<?php

interface interfaceLockService
{
    public function createLock($length, $provider);
    public function deleteLock($id);
}

?>
