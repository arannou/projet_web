<?php

interface interfaceBorrowingsDAO
{

  // Singleton
  public static function getInstance();

  /**
   * Retourne tous les emprunts
   *
   * @return mixed
   */
  public function getBorrowings();

  /**
   * Retourne l'emprunt dont l'id est passé en paramètre
   *
   * @param $id
   * @return mixed
   */
  public function getBorrowingById($id);

  /**
   * Ajoute un emprunt
   *
   * @param $borrow
   * @return mixed
   */
  public function addBorrow($borrow);
}

?>
