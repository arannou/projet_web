<?php

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 23/06/17
 * Time: 09:25
 */

require_once 'Model/DAO/implementationBorrowingsDAO_MYSQL.php';
require_once 'Model/DAO/implementationDoorDAO_MYSQL.php';
require_once 'Model/DAO/ImplementationKeychainDAO_MYSQL.php';
require_once 'Model/DAO/implementationKeyKeychainDAO_MYSQL.php';
require_once 'Model/DAO/implementationKeyDAO_MYSQL.php';
require_once 'Model/DAO/implementationLockDAO_MYSQL.php';
require_once 'Model/DAO/implementationRoomDAO_MYSQL.php';
require_once 'Model/DAO/implementationUserDAO_MYSQL.php';
require_once 'Model/DAO/implementationFournisseurDAO_MYSQL.php';
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
        return implementationBorrowingsDAO_MYSQL::getInstance();
    }

    public function getDoorDAO()
    {
        return implementationDoorDAO_MYSQL::getInstance();
    }

    public function getFournisseurDAO()
    {
        return implementationFournisseurDAO_MYSQL::getInstance();
    }

    public function getKeychainDAO()
    {
        return implementationKeychainDAO_MYSQL::getInstance();
    }

    public function getKeyDAO()
    {
        return implementationKeyDAO_MYSQL::getInstance();
    }

    public function getKeyKeychainDAO()
    {
        return implementationKeyKeychainDAO_MYSQL::getInstance();
    }

    public function getLockDAO()
    {
        return implementationLockDAO_MYSQL::getInstance();
    }

    public function getRoomDAO()
    {
        return implementationRoomDAO_MYSQL::getInstance();
    }

    public function getUserDAO()
    {
        return implementationUserDAO_MYSQL::getInstance();
    }
}