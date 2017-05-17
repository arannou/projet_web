<?php
require_once 'Model/DAO/interfaceBorrowingsDAO.php';
class implementationBorrowingsDAO_Session implements interfaceBorrowingsDAO
{

    /**
    * @var Singleton
    * @access private
    * @static
    */
    private static $_instance = null;

    /**
    * Méthode qui crée l'unique instance de la classe
    * si elle n'existe pas encore puis la retourne.
    *
    * @param void
    * @return Singleton
    */
    public static function getInstance() {

        if(is_null(self::$_instance)) {
            self::$_instance = new implementationBorrowingsDAO_Session();
        }

        return self::$_instance;
    }

    public function getBorrowings(){
        return $_SESSION['borrowings'];
    }

    public function getBorrowingById($id){
        foreach ($this->getBorrowings() as $key => $borrowing) {
            if($borrowing['borrowingId'] == $id){
                return $borrowing;
            }
        }

        return null;
    }

    public function addBorrow($borrow){
        $_SESSION['borrowings'][] = $borrow;
    }

}

?>
