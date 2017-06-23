<?php

require_once 'Model/DAO/interfaceKeyKeychainDAO.php';
require_once 'Model/DAO/implementationKeyDAO_Session.php';

class implementationKeyKeychainDAO_Session implements interfaceKeyKeychainDAO
{

    private static $_instance;

    private $_keyDAO;

    private function __construct(){
        parent::initDb();
        $this->_keyDAO = implementationKeyDAO_Session::getInstance();
    }

    public static function getInstance(){
        if(is_null(self::$_instance)) {
            self::$_instance = new implementationKeyKeychainDAO_Session();
        }
        return self::$_instance;
    }

    public function create($key, $keyChain){
        $relation = [];
        $relation['keyId'] = $key->getId();
        $relation['keychainId'] = $keyChain->getId();

        array_push($_SESSION['keyKeychain'], $relation);
    }

    public function getKeysByKeychainId($keychainId){
        $keys = [];
        foreach ($_SESSION['keyKeychain'] as $index => $key) {
            if($key['keychainId'] == $keychainId){
                $k = $this->_keyDAO->getKeyById($key['keyId']);
                array_push($keys, $k);
            }
        }
        return $keys;
    }

}

?>
