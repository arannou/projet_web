<?php

// Declaration de l'interface 'iTemplate'
interface interfaceUserDAO
{
    // Retrieves the corresponding row for the specified user ID.
    //public function getByUserId($userId);

    // Singleton
    public static function getInstance();

    /**
     * Retoune les utilisateurs
     *
     * @return mixed
     */
    public function getUsers();

    public function populate();

    /**
     * Retourne l'utilsateur dont l'enssat primary key est donné
     *
     * @param $enssatPrimaryKey
     * @return mixed
     */
    public function getUserByEnssatPrimaryKey($enssatPrimaryKey);


    /**
     * Ajoute un utilisateur
     *
     * @param $user
     * @return mixed
     */
    public function addUser($user);
}

?>
