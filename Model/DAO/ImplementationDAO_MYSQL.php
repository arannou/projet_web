<?php

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 23/06/17
 * Time: 08:58
 */
class ImplementationDAO_MYSQL
{
    protected $pdo;

    protected function initDb(){
        $dbConnection = new MysqlDbConnection();
        $this->pdo = $dbConnection->getPDO();
    }
}