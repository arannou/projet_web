<?php

require_once 'Model/Service/interfaceDoorService.php';
require_once 'Model/DAO/implementationDoorDAO_Dummy.php';

class implementationDoorService implements interfaceDoorService
{
  /**
   * @var Singleton
   * @access private
   * @static
   */
   private static $_instance = null;

   private $_doors = array(); // doorId
   private $_doorDAO;

   /**
   * Constructeur de la classe
   *
   * @param void
   * @return void
   */
   private function __construct()
   {
     $this->_doorDAO = implementationDoorDAO_Dummy::getInstance();
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
       self::$_instance = new implementationDoorService();
   }

     return self::$_instance;
   }
	
	    //on crée une porte
    public function createDoor($room, $lock)
    {
      $this->_doorDAO->add($room, $lock);
	}

    public function addLockToDoor(){
		
	}

    public function deleteLockToDoor(){
		
	}
}

?>
