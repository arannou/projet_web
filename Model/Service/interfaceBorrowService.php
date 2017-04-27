<?php


interface interfaceBorrowService
{
  //on emprunte toujours un trousseau
    public function borrowKeychain($userId,$keychainId,DateTime $dueDate);

    public function returnKeychain($borrowingId,$comment);

    public function lostKeychain($borrowingId,$comment);

    public function getBorrowings();
}



?>
