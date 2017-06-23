<?php

require_once 'Model/DAO/interfaceKeyKeychainDAO.php';
require_once 'Model/DAO/implementationKeyDAO_Session.php';
require_once 'Model/DAO/ImplementationDAO_MYSQL.php';

class implementationKeyKeychainDAO_MYSQL extends ImplementationDAO_MYSQL implements interfaceKeyKeychainDAO
{

    private static $_instance;
    private $_tableName = "keys_keychain";

    private $_keyDAO;

    private function __construct(){
        $factory = getDAOFactory();
        $this->_keyDAO = $factory->getKeyDAO();
    }

    public static function getInstance(){
        if(is_null(self::$_instance)) {
            self::$_instance = new implementationKeyKeychainDAO_MYSQL();
        }
        return self::$_instance;
    }

    public function create($key, $keyChain){
        $stmt = $this->pdo->prepare("INSERT INTO $this->_tableName
			(keyId, keychainId)
			VALUES (:keyId, :keychainId)");
        
        $keyId = $key->getId();
        $keychainId = $keyChain->getId();

        $stmt->bindParam(':keyId', $keyId);
        $stmt->bindParam(':keychainId', $keychainId);

        $stmt->execute();
    }

    public function getKeysByKeychainId($keychainId){
        $keys = [];

        $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE keychainId = :kid");
        $stmt->bindParam(":kid", $keychainId);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $k = $this->_keyDAO->getKeyById($row['keyId']);
            array_push($keys, $k);
        }

        return $keys;
    }

}

?>
