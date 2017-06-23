<?php

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 23/06/17
 * Time: 09:39
 */
class FactoryProvider
{
    public static $FACTORY_SESSION = 1;
    public static $FACTORY_MYSQL   = 2;

    private $factory;

    public function __construct($factoryType)
    {
        switch ($factoryType){
            case FactoryProvider::$FACTORY_SESSION:
                $this->factory = DAOFactory_Session::getInstance();
            break;

            case FactoryProvider::$FACTORY_MYSQL:
                $this->factory = DAOFactory_MYSQL::getInstance();
            break;

            default:
                $this->factory = DAOFactory_Session::getInstance();
        }
    }

    public function getFactory(){
        return $this->factory;
    }
}