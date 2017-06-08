<?php

require_once 'Model/DAO/implementationKeyDAO_Dummy.php';
require_once 'Model/DAO/implementationKeychainDAO_Dummy.php';
require_once 'Model/DAO/implementationBorrowingsDAO_Session.php';
class implementationKeyService_Dummy
{

    /**
    * @var Singleton
    * @access private
    * @static
    */
    private static $_instance = null;

    private $_keyDAO;


    /**
    * Constructeur de la classe
    *
    * @param void
    * @return void
    */
    private function __construct()
    {
        $this->_keyDAO  = implementationKeyDAO_Dummy::getInstance();
        $this->_keychainDAO   = implementationKeychainDAO_Dummy::getInstance();
        $this->_borrowingsDAO = implementationBorrowingsDAO_Session::getInstance();
    }

    /**
    * Méthode qui crée l'unique instance de la classe
    * si elle n'existe pas encore puis la retourne.
    *
    * @param void
    * @return Singleton
    */
    public static function getInstance() {

        if(is_null(self::$_instance)) {
            self::$_instance = new implementationKeyService_Dummy();
        }

        return self::$_instance;
    }

    public function createKeyFromCSV($id, $type) {
        if(!$this->checkKeyByIdKey($id)) {
            $key = new KeyVO();
            $key->setId((int)$id);
            $key->setType($type);
            $this->_keyDAO->addKey($key);
        }
    }

    public function checkKeyByIdKey($idKey) {
        if ($this->_keyDAO->getKeyById($idKey) != null) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getAvailableKeys(){
        $keys = $this->_keyDAO->getKeys();
        $availableKeys = [];

        foreach ($keys as $index => $key) {
            if($key->getKeychainId() == null){ //The key is not in a keychain
                array_push($availableKeys, $key);
            }
        }

        return $availableKeys;
    }

    public function isKeyAvailable($keyId){
        $key = $this->_keyDAO->getKeyById($keyId);
        if($key->getKeychainId() != null){
            return false;
        }else {
            return true;
        }
    }

    public function getKeysOfKeychain($keychainId)
    {
      $keysArray = null;
      $keys = $this->_keyDAO->getKeys();
      foreach ($keys as $index => $key) {
        if ($keychainId == $key->getKeychainId()) {
          $keysArray[] = $key->getId();
        }
      }
    }
}
?>
