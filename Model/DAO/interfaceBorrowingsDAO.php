<?php

interface interfaceBorrowingsDAO
{

  // Singleton
  public static function getInstance();

  public function getBorrowings();
  public function getBorrowingById($id);

  public function addBorrow($borrow);
}

?>
