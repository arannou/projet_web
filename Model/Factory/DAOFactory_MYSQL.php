<?php

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 23/06/17
 * Time: 09:25
 */
class DAOFactory_MYSQL implements DAOFactoryInterface
{

    private static $_instance = null;

    /**
     * Méthode qui crée l'unique instance de la classe
     * si elle n'existe pas encore puis la retourne.
     *
     * @param void
     * @return Singleton
     */
    public static function getInstance() {

        if(is_null(self::$_instance)) {
            self::$_instance = new DAOFactory_MYSQL();
        }

        return self::$_instance;
    }

    public function getBorrowingsDAO()
    {
        // TODO: Implement getBorrowingsDAO() method.
    }

    public function getDoorDAO()
    {
        // TODO: Implement getDoorDAO() method.
    }

    public function getFournisseurDAO()
    {
        // TODO: Implement getFournisseurDAO() method.
    }

    public function getKeychainDAO()
    {
        // TODO: Implement getKeychainDAO() method.
    }

    public function getKeyDAO()
    {
        // TODO: Implement getKeyDAO() method.
    }

    public function getKeyKeychainDAO()
    {
        // TODO: Implement getKeyKeychainDAO() method.
    }

    public function getLockDAO()
    {
        // TODO: Implement getLockDAO() method.
    }

    public function getRoomDAO()
    {
        // TODO: Implement getRoomDAO() method.
    }

    public function getUserDAO()
    {
        // TODO: Implement getUserDAO() method.
    }
}