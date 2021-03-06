<?php
require_once 'Model/VO/KeyVO.php';
require_once 'Model/DAO/interfaceKeyDAO.php';

class implementationKeyDAO_Session implements interfaceKeyDAO
{

    private $_keys = array();

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
        /**/

    }

    public function populate() {
        if (file_exists(dirname(__FILE__).'/keys.xml')) {
            $keys = simplexml_load_file(dirname(__FILE__).'/keys.xml');
            foreach($keys as $xmlkey)
            {
                $key = new keyVO;
                $key->setId(intval($xmlkey->id));
                $key->setType((string)$xmlkey->type);
                $key->setLockId((int)$xmlkey->lockId);

                array_push($_SESSION['keys'],$key);
            }
        } else {
            throw new RuntimeException('Echec lors de l\'ouverture du fichier keys.xml.');
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
            self::$_instance = new implementationKeyDAO_Session();
        }
        return self::$_instance;
    }

    public function getKeys()
    {
        return $_SESSION['keys'];
    }

    public function getKeyById($idKey) {
        foreach ($this->getKeys() as $key => $cle) {
            if($idKey == $cle->getId()) {
                return $cle;
            }
        }
        return null;
    }

    public function getKeychainOfKey($keychainId, $keyId) {
        if($keychainId == $this->getKeyById($keyId)->getKeychainId()) {
            return $keychainId;
        }
        return null;
    }

    public function addKey($key) {
        array_push($_SESSION['keys'], $key);
    }

    public function updateKey($updatedKey){
        $keyId = $updatedKey->getId();
        $keys = $_SESSION['keys'];
        foreach ($keys as $index => $key) {
            if($key->getId() == $keyId){
                $_SESSION['keys'][$index] = $updatedKey;
            }
        }

    }

    public function getKeyByLockId($lockId){
      foreach ($this->getKeys() as $index => $key) {
          if($key->getLockId() == $lockId) {
              return $key;
          }
      }
      return null;
    }

}


?>
