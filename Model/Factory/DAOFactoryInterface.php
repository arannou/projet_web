<?php

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 23/06/17
 * Time: 09:18
 */
interface DAOFactoryInterface
{
    public function getBorrowingsDAO();

    public function getDoorDAO();

    public function getFournisseurDAO();

    public function getKeychainDAO();

    public function getKeyDAO();

    public function getKeyKeychainDAO();

    public function getLockDAO();

    public function getRoomDAO();

    public function getUserDAO();
}