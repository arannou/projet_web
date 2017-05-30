<?php
require_once 'Model/DAO/interfaceFournisseurDAO.php';

class implementationFournisseurDAO_Session implements interfaceFournisseurDAO
{

  private $_providers = array();

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
     if (file_exists(dirname(__FILE__).'/providers.xml')) {
       $providers = simplexml_load_file(dirname(__FILE__).'/providers.xml');
       foreach($providers->children() as $xmlProvider)
       {
         $provider = new ProviderVO;

         $provider->setId((float) $xmlProvider->id);
         $provider->setUsername((String) $xmlProvider->username);
         $provider->setName((String) $xmlProvider->name);
         $provider->setSurname((String) $xmlProvider->surname);
         $provider->setPhone((String) $xmlProvider->phone);
         $provider->setOffice((String) $xmlProvider->office);
         $provider->setEmail((String) $xmlProvider->email);

         array_push($_SESSION['providers'],$provider);
       }
     } else {
       exit('Echec lors de l\'ouverture du fichier providers.xml.');
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
       self::$_instance = new implementationFournisseurDAO_Session();
     }

     return self::$_instance;
   }


       public function getProviders(){
           return $_SESSION['providers'];
       }

       public function getProviderById($id){
           foreach ($this->getProviders() as $key => $provider) {
               if($provider['providerId'] == $id){
                   return $provider;
               }
           }

           return null;
       }

       public function getProviderByUsername($username){
           foreach ($this->getProviders() as $key => $provider) {
               if($provider['providerUsername'] == $username){
                   return $provider;
               }
           }

           return null;
       }

       public function getProviderByName($name){
           foreach ($this->getProviders() as $key => $provider) {
               if($provider['providerName'] == $name){
                   return $provider;
               }
           }

           return null;
       }

       public function getProviderBySurname($surname){
           foreach ($this->getProviders() as $key => $provider) {
               if($provider['providerSurname'] == $surname){
                   return $provider;
               }
           }

           return null;
       }

       public function getProviderByPhone($phone){
           foreach ($this->getProviders() as $key => $provider) {
               if($provider['providerPhone'] == $phone){
                   return $provider;
               }
           }

           return null;
       }

       public function getProviderByOffice($office){
           foreach ($this->getProviders() as $key => $provider) {
               if($provider['providerOffice'] == $office){
                   return $provider;
               }
           }

           return null;
       }

       public function getProviderByEmail($email){
           foreach ($this->getProviders() as $key => $provider) {
               if($provider['providerEmail'] == $email){
                   return $provider;
               }
           }

           return null;
       }

       public function addProvider($provider){
           $_SESSION['providers'][] = $provider;
       }

}


?>
