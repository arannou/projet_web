<?php

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 23/06/17
 * Time: 08:26
 */
class MysqlDbConnection
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PWD);
    }

    public function close(){
        $this->pdo = null;
    }

    public function getPDO(){
        return $this->pdo;
    }

}