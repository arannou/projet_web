<?php
require_once 'Model/VO/KeychainVO.php';
require_once 'Model/DAO/interfaceKeychainDAO.php';
require_once 'Model/DAO/implementationKeyKeychainDAO_Session.php';

class implementationKeychainDAO_Session implements interfaceKeyChainDAO
{

    private $keyKeychainDAO;

    /**
     * @var Singleton
     * @access private
     * @static
     */
    private static $_instance = null;

    /**
     * Constructeur de la classe
     *
     * @param void
     * @return void
     */
    private function __construct() {
        $factory = getDAOFactory();
        $this->keyKeychainDAO = $factory->getKeyKeychainDAO();
    }

    public function populate(){
        if (file_exists(dirname(__FILE__).'/keychains.xml')) {
            $keychains = simplexml_load_file(dirname(__FILE__).'/keychains.xml');
            foreach($keychains->children() as $xmlKeychain)
            {
                $keychain = new KeychainVO;

                $keychain->setId((float) $xmlKeychain->id);
                $tDate = new DateTime;
                $tDate->setTimestamp((int)$xmlKeychain->creationDate);
                $keychain->setCreationDate($tDate);
                $tDate->setTimestamp((int)$xmlKeychain->destructionDate);
                $keychain->setDestructionDate($tDate);

                array_push($_SESSION['keychains'],$keychain);
            }
        } else {
            exit('Echec lors de l\'ouverture du fichier keychains.xml.');
        }
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
            self::$_instance = new implementationKeychainDAO_Session();
        }

        return self::$_instance;
    }

    public function addKeychain($keychain){
        $lastId = 0;
        $keychains = $this->getKeychains();
        //Si aucun trousseau n'est créé, on commence notre incrémentation d'identifiant à 0
        if (count($keychains) != 0) {
            //On ajoute un identifiant de trousseau à la suite des autres
            $lastId = end($keychains)->getId();
        }

        $keychain->setId($lastId+1);
        array_push($_SESSION['keychains'], $keychain);

        return $lastId+1;
    }

    public function getKeychains()
    {
        $keychains = $_SESSION['keychains'];
        foreach ($keychains as $index => $keychain){
            $keys = $this->keyKeychainDAO->getKeysByKeychainId($keychain->getId());
            $keychain->setKeys($keys);
        }

        return $keychains;
    }

    public function getKeychainById($keychainId)
    {
        foreach ($this->getKeychains() as $key => $keychain) {
            if($keychainId == $keychain->getId()) {
                $keys = $this->keyKeychainDAO->getKeysByKeychainId($keychain->getId());
                $keychain->setKeys($keys);
                return $keychain;
            }
        }
        return null;
    }
}


?>
