<?php

interface interfaceLockDAO
{
  public function populate();

  public static function getInstance();

  /**
   * Retourne les canons
   *
   * @return mixed
   */
  public function getLocks();

  /**
   * Retourne le canon dont l'id est donné
   *
   * @param $id
   * @return mixed
   */
  public function getLockById($id);

  /**
   * retourne les canons sont la taille est donnée
   *
   * @param $length
   * @return mixed
   */
  public function getLocksByLength($length);

  /**
   * Ajoute un canon
   *
   * @param $lock
   * @return mixed
   */
  public function addLock($lock);

  /**
   * Supprime un canon
   *
   * @param $id
   * @return mixed
   */
  public function removeLockById($id);
}

?>
