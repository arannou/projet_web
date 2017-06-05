<?php

interface interfaceLockDAO
{
  public function populate();

  public static function getInstance();

  public function getLocks();

  public function getLockById();

  public function getLocksByLength($length);

  public function addLock($lock);

  public function removeLockById($id);
}

?>
