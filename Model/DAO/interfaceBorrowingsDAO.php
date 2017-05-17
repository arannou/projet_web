<?php

interface interfaceBorrowingsDAO
{

    // Singleton
    public static function getInstance();

    public function getBorrowings();

    public function addBorrow($borrow);
}

?>
