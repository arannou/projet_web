<?php

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 23/06/17
 * Time: 09:13
 */
require_once 'Model/Factory/DAOFactoryInterface.php';

require_once 'Model/DAO/implementationBorrowingsDAO_Session.php';
require_once 'Model/DAO/implementationDoorDAO_Session.php';
require_once 'Model/DAO/implementationKeychainDAO_Session.php';
require_once 'Model/DAO/implementationKeyKeychainDAO_Session.php';
require_once 'Model/DAO/implementationKeyDAO_Session.php';
require_once 'Model/DAO/implementationLockDAO_Session.php';
require_once 'Model/DAO/implementationRoomDAO_Session.php';
require_once 'Model/DAO/implementationUserDAO_Session.php';
require_once 'Model/DAO/implementationFournisseurDAO_Session.php';

class DAOFactory_Session implements DAOFactoryInterface
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
            self::$_instance = new DAOFactory_Session();
        }

        return self::$_instance;
    }
    public function getBorrowingsDAO(){
        return implementationBorrowingsDAO_Session::getInstance();
    }

    public function getDoorDAO(){
        return implementationDoorDAO_Session::getInstance();
    }

    public function getFournisseurDAO(){
        return implementationFournisseurDAO_Session::getInstance();
    }

    public function getKeychainDAO(){
        return implementationKeychainDAO_Session::getInstance();
    }

    public function getKeyDAO(){
        return implementationKeyDAO_Session::getInstance();
    }
    public function getKeyKeychainDAO(){
        return implementationKeyKeychainDAO_Session::getInstance();
    }

    public function getLockDAO(){
        return implementationLockDAO_Session::getInstance();
    }

    public function getRoomDAO(){
        return implementationRoomDAO_Session::getInstance();
    }

    public function getUserDAO(){
        return implementationUserDAO_Session::getInstance();
    }
}