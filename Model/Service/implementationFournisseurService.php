<?php

require_once 'Model/Service/interfaceFournisseurService.php';
require_once 'Model/DAO/implementationFournisseurDAO_Session.php';

class implementationFournisseurService implements interfaceFournisseurService
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
     $factory = getDAOFactory();
     $this->_providersDAO = $factory->getFournisseurDAO();
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
          self::$_instance = new implementationFournisseurService();
      }

        return self::$_instance;
      }

    //On récupère le fournisseur à l'aide de son identifiant
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

    //On récupère la liste des fournisseurs
    public function getProviders()
    {
      return $this->_providersDAO->getProviders();
    }
}

?>
