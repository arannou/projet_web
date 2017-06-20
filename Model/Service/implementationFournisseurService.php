<?php

require_once 'Model/Service/interfaceFournisseurService.php';
require_once 'Model/DAO/implementationFournisseurDAO_Session.php';

class implementationFournisseurService_Dummy implements interfaceFournisseurService
{


  /**
   * @var Singleton
   * @access private
   * @static
   */
   private static $_instance = null;

   private $_providers = array(); // providerId, username, name, surname, phone, office, email
   private $_providersDAO;

   /**
   * Constructeur de la classe
   *
   * @param void
   * @return void
   */
   private function __construct()
   {
     $this->_providersDAO = implementationFournisseurDAO_Session::getInstance();
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
          self::$_instance = new implementationFournisseurService_Dummy();
      }

        return self::$_instance;
      }

    //@todo : Remplacer l'utilisation de cette fonction par celle présente en DAO
    public function getProviderById($providerId)
    {
      $provider=null;
      $providers = $this->getProviders();
      if(count($providers)+1 > $providerId)
      {
        $provider = $providers[$providerId-1];

      }
      return $provider;
    }

    public function getProviders()
    {
      return $this->_providersDAO->getProviders();
    }

}

?>
