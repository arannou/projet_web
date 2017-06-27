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
        $factory = getDAOFactory();

        $this->_keychainDAO    = $factory->getKeychainDAO();
        $this->_borrowingsDAO  = $factory->getBorrowingsDAO();
        $this->_keyDAO         = $factory->getKeyDAO();
        $this->_keyKeychainDAO = $factory->getKeyKeychainDAO();
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

    //On crée un trousseau
    public function createKeychain($creationDate, $dueDate, $keys)
    {
        $keychains = $this->_keychainDAO->getKeychains();
        //Si aucun trousseau n'est créé, on commence notre incrémentation d'identifiant à 0
        if (count($keychains) == 0) {
            $newId = 0;
        } else { //Sinon, on ajoute un identifiant de trousseau à la suite des autres
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

    //Vérification de l'existance d'un trousseau
    public function isKeychainAvailable($id){
        $borrowings = $this->borrowService->getCurrentBorrowings();
        foreach ($borrowings as $key => $borrowing) {
            if($borrowing->getKeychainId() == $id){
                return false;
            }
        }
        return true;
    }

    //Récupération des trousseaux existants
    public function getExistingKeychains(){
        $keychains = $this->_keychainDAO->getKeychains();

        $availableKeychains = [];
        foreach ($keychains as $index => $keychain){
            if($keychain->getDestructionDate() == null){
                array_push($availableKeychains, $keychain);
            }
        }
    }

    //Créaction de trousseaux à l'aide d'un CSV
    public function createKeychainFromCSV($keychainId, $creationDate, $destructionDate, $keys) {
        if(!$this->checkKeychainById($keychainId)) {
            $keychain = new KeychainVO;
            $keychain->setId((int)$keychainId);
            $dateCreation = DateTime::createFromFormat('Y-m-d', $creationDate);
            $keychain->setCreationDate($dateCreation);
            $dateDestruction = DateTime::createFromFormat('Y-m-d', $destructionDate);
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

    //Vérification de la disponibilité d'une clé
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

    //Vérification de l'existance d'un trousseau à l'aide de son identifiant
    public function checkKeychainById($keychainId) {
        if ($this->_keychainDAO->getKeychainById($keychainId) != null) {
            return true;
        }
        else {
            return false;
        }
    }
}
