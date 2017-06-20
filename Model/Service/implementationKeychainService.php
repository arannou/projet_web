<?php


require_once 'Model/DAO/implementationKeyDAO_Session.php';
require_once 'Model/DAO/implementationBorrowingsDAO_Session.php';
require_once 'Model/DAO/implementationKeyKeychainDAO_Session.php';
require_once 'Model/Service/interfaceKeychainService.php';
require_once 'Model/Service/implementationKeyService.php';
require_once 'Model/Service/implementationBorrowService.php';

class implementationKeychainService implements interfaceKeychainService
{

    /**
     * @var Singleton
     * @access private
     * @static
     */
    private static $_instance = null;

    private $_keyDAO;
    private $_keychainDAO;
    private $_borrowingsDAO;
    private $_keyKeychainDAO;
    private $borrowService;

    /**
     * Constructeur de la classe
     *
     * @param void
     * @return void
     */
    private function __construct()
    {
        $this->_keychainDAO   = implementationKeychainDAO_Session::getInstance();
        $this->_borrowingsDAO = implementationBorrowingsDAO_Session::getInstance();
        $this->_keyDAO        = implementationKeyDAO_Session::getInstance();
        $this->_keyKeychainDAO = implementationKeyKeychainDAO_Session::getInstance();
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
            self::$_instance = new implementationKeychainService();
        }

        return self::$_instance;
    }


    public function createKeychain($creationDate, $dueDate, $keys)
    {
        $keychains = $this->_keychainDAO->getKeychains();
        if (count($keychains) == 0) {
            $newId = 0;
        } else {
            $newId = $keychains[count($keychains) - 1]->getId() + 1;
        }

        $keychain = new KeychainVO;
        $keychain->setId($newId);
        $keychain->setCreationDate($creationDate);
        $keychain->setDestructionDate($dueDate);

        foreach ($keys as $index => $keyId) {
            if($this->isKeyAvailable((int)$keyId)) {
                $key = $this->_keyDAO->getKeyById((int)$keyId);
                $this->_keyKeychainDAO->create($key, $keychain);
            }
        }

        $this->_keychainDAO->addKeychain($keychain);

        return $keychain;
    }

    public function isKeychainAvailable($id){
        $borrowings = $this->borrowService->getCurrentBorrowings();
        foreach ($borrowings as $key => $borrowing) {
            if($borrowing->getKeychainId() == $id){
                return false;
            }
        }
        return true;
    }

    public function getExistingKeychains(){
        $keychains = $this->_keychainDAO->getKeychains();

        $availableKeychains = [];
        foreach ($keychains as $index => $keychain){
            if($keychain->getDestructionDate() == null){
                array_push($availableKeychains, $keychain);
            }
        }
    }

    public function createKeychainFromCSV($keychainId, $creationDate, $dueDate, $keys) {
        if(!$this->checkKeychainById($keychainId)) {
            $keychain = new KeychainVO;
            $keychain->setId((int)$keychainId);
            $dateCreation = DateTime::createFromFormat('Y-m-d', $creationDate);
            $keychain->setCreationDate($dateCreation);
            $dateDestruction = DateTime::createFromFormat('Y-m-d', $dueDate);
            $keychain->setDestructionDate($dateDestruction);
            $parsedKeys = explode(',', $keys);
            foreach ($parsedKeys as $index => $keyId) {
                if($this->isKeyAvailable((int)$keyId)) {
                    $key = $this->_keyDAO->getKeyById((int)$keyId);
                    $this->_keyKeychainDAO->create($key, $keychain);
                }
            }
            $this->_keychainDAO->addKeychain($keychain);
        }
    }

    public function isKeyAvailable($keyId){
        $existingKeychains = $this->getExistingKeychains();

        foreach ($existingKeychains as $index => $keychain){
            foreach ($keychain->getKeys() as $keychainKey){
                if($keyId == $keychainKey->getId()){
                    return false;
                }
            }
        }

        return true;
    }

    public function checkKeychainById($keychainId) {
        if ($this->_keychainDAO->getKeychainById($keychainId) != null) {
            return true;
        }
        else {
            return false;
        }
    }

}
