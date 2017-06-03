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
        $key = new KeyVO();
        $key->setId($id);
        $key->setType($type);
        $this->_keyDAO->addKey($key);
      }

      public function getAvailableKeys(){
          $keys = $this->_keyDAO->getKeys();
          $availableKeys = [];

          foreach ($keys as $index => $key) {
              if($this->isKeyAvailable($key->getId())){
                  array_push($availableKeys, $key);
              }
          }

          return $availableKeys;
      }

      public function isKeyAvailable($keyId){
          $keychains = $this->_keychainDAO->getKeychains();

          foreach ($keychains as $index => $keychain) {
              foreach ($keychain->getKeysIds() as $keyIndex => $key) {
                  if($key == $keyId){
                      return false;
                  }
              }
          }

          return true;
      }
}
?>
