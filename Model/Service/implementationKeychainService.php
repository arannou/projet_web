<?php


require_once 'Model/DAO/implementationKeyDAO_Dummy.php';
require_once 'Model/Service/interfaceKeychainService.php';

class implementationKeychainService implements interfaceKeychainService
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
          self::$_instance = new implementationKeychainService();
      }

        return self::$_instance;
    }

<<<<<<< HEAD
    public function createKeychain($creationDate, $dueDate){
=======
    public function createKeychain($creationDate, $dueDate, $keys){
>>>>>>> 124624c83fb56207e6554591c7e8c648675dae7c
        $keychains = $this->_keychainDAO->getKeychains();
        $newId = $keychains[count($keychains)-1]->getId()+1;

        $keychain = new KeychainVO;
        $keychain->setId($newId);
        $keychain->setCreationDate($creationDate);
        $keychain->setDestructionDate($dueDate);
<<<<<<< HEAD
=======
        $keychain->setKeysIds($keys);
>>>>>>> 124624c83fb56207e6554591c7e8c648675dae7c

        $this->_keychainDAO->addKeychain($keychain);

        return $keychain;
    }

}
