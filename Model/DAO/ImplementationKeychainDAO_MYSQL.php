<?php

/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 23/06/17
 * Time: 10:38
 */

require_once 'Model/DAO/interfaceKeychainDAO.php';
require_once 'Model/DAO/ImplementationDAO_MYSQL.php';

class ImplementationKeychainDAO_MYSQL extends ImplementationDAO_MYSQL implements interfaceKeyChainDAO
{

    private $keyKeychainDAO;

    /**
     * @var Singleton
     * @access private
     * @static
     */
    private static $_instance = null;
    private $_tableName       = "keychain";

    /**
     * Constructeur de la classe
     *
     * @param void
     * @return void
     */
    private function __construct() {

        parent::initDb();

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

                $this->addKeychain($keychain);
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
            self::$_instance = new implementationKeychainDAO_MYSQL();
        }

        return self::$_instance;
    }

    public function addKeychain($keychain)
    {
        $stmt = $this->pdo->prepare("INSERT INTO $this->_tableName 
                                      (creationDate, destructionDate) 
                                      VALUES (:creationDate, :destructionDate)");

        $stmt->bindParam(':creationDate', $keychain->getCreationDate());
        $stmt->bindParam(':destructionDate', $keychain->getDestructionDate());

        $stmt->execute();
    }

    public function getKeychains()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName");
        $stmt->execute();

        $keychains = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $kc = new KeychainVO();

            $kc->setId($row['id']);
            $kc->setCreationDate($row['creationDate']);
            $kc->setDestructionDate($row['destructionDate']);

            $keys = $this->keyKeychainDAO->getKeysByKeychainId($row['id']);
            $kc->setKeys($keys);

            array_push($keychains, $kc);
        }

        return $keychains;
    }

    public function getKeychainById($keychainId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE id = :id");
        $stmt->bindParam(':id', $keychainId);
        $stmt->execute();

        $keychains = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $kc = new KeychainVO();

            $kc->setId($row['id']);
            $kc->setCreationDate($row['creationDate']);
            $kc->setDestructionDate($row['destructionDate']);

            $keys = $this->keyKeychainDAO->getKeysByKeychainId($row['id']);
            $kc->setKeys($keys);

            array_push($keychains, $kc);
        }

        return $keychains;
    }
}