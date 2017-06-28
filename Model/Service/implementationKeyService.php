<?php

require_once 'Model/DAO/implementationKeyDAO_Session.php';
require_once 'Model/DAO/implementationKeychainDAO_Session.php';
require_once 'Model/DAO/implementationBorrowingsDAO_Session.php';
require_once 'Model/DAO/implementationLockDAO_Session.php';
require_once 'Model/DAO/implementationDoorDAO_Session.php';
require_once 'Model/Service/implementationKeychainService.php';

class implementationKeyService
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
        $factory = getDAOFactory();

        $this->_keyDAO          = $factory->getKeyDAO();
        $this->_keychainDAO     = $factory->getKeychainDAO();
        $this->_borrowingsDAO   = $factory->getBorrowingsDAO();
        $this->_lockDAO         = $factory->getLockDAO();
        $this->_doorDAO         = $factory->getDoorDAO();
        $this->_keychainService = implementationKeychainService::getInstance();
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
            self::$_instance = new implementationKeyService();
        }

        return self::$_instance;
    }

    //Création d'une clé
    public function createKey($id, $type, $lockId) {
        if(!$this->checkKeyByIdKey($id)) {
            $key = new KeyVO();
            $key->setId((int)$id);
            $key->setType($type);
            $key->setLockId($lockId);
            $this->_keyDAO->addKey($key);
        }
    }

    //Vérification de l'existance d'une clé à l'aide de son identifiant
    public function checkKeyByIdKey($idKey) {
        if ($this->_keyDAO->getKeyById($idKey) != null) {
            return true;
        }
        else {
            return false;
        }
    }

    //Récupération de la liste des clés disponibles
    public function getAvailableKeys(){
        $keys = $this->_keyDAO->getKeys();
        $availableKeys = [];

        foreach ($keys as $index => $key) {
            if($this->_keychainService->isKeyAvailable($key->getId())){
                array_push($availableKeys, $key);
            }
        }
        return $availableKeys;
    }

    //Récupération des clés d'un trousseau
    public function getKeysOfKeychain($keychainId)
    {
        $keysArray = null;
        $keys = $this->_keyDAO->getKeys();
        foreach ($keys as $index => $key) {
            if ($keychainId == $key->getKeychainId()) {
                $keysArray[] = $key->getId();
            }
        }
        return $keysArray;
    }

    //Récupération des portes associées à une clé
    public function getDoorByKeyId($keyId)
    {
        $key = $this->_keyDAO->getKeyById($keyId);
        $lockId = $key->getLockId();
        $lock   = $this->_lockDAO->getLockById($lockId);

        $door = null;

        if($lock != null){
            $doorId = $lock->getDoorId();
            $door   = $this->_doorDAO->getDoorById($doorId);
        }

        return $door;
    }
}
?>
