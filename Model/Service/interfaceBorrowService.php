<?php


interface interfaceBorrowService
{
  //on emprunte toujours un trousseau
  public static function getInstance();

  public function borrowKeychain($user,$keychain,DateTime $dueDate);

  public function returnKeychain($borrowingId,$comment);

  public function lostKeychain($borrowingId,$comment);

  public function getBorrowingsWithStatus();

  public function getBorrowingById($borrowingId);

  public function getBorrowingByKeychainId($keychainId);

  public function getBorrowingStatus($borrowingId);

  public function setBorrowingStatus($borrowingId,$status);

  //private function _cancelBorrowing($borrowingId,$type,$comment);
}
?>
