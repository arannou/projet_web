<?php
require_once 'Model/DAO/interfaceBorrowingsDAO.php';
class implementationBorrowingsDAO_MYSQL extends ImplementationDAO_MYSQL implements interfaceBorrowingsDAO
{

    /**
     * @var Singleton
     * @access private
     * @static
     */
    private static $_instance = null;
    private $_tableName       = "borrowing";

    private function __construct(){
        parent::initDb();
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
            self::$_instance = new implementationBorrowingsDAO_Session();
        }

        return self::$_instance;
    }

    public function getBorrowings(){
        $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName");
        $stmt->execute();

        $borrowings = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $borrowing = [
                'borrowingId'=>$row["borrowingId"],
                'userEnssatPrimaryKey'=>$row["userEnssatPrimaryKey"],
                'keychainId'=>$row["keychainId"],
                'borrowDate'=>$row["borrowDate"],
                'dueDate'=>$row["dueDate"],
                'returnDate'=>$row["returnDate"],
                'lostDate'=>$row["lostDate"],
                'comment'=>$row["comment"]
            ];

            array_push($borrowings, $borrowing);
        }

        return $borrowings;
    }

    public function getBorrowingById($id){
        $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE borrowingId = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $borrowings = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $borrowing = [
                'borrowingId'=>$row["borrowingId"],
                'userEnssatPrimaryKey'=>$row["userEnssatPrimaryKey"],
                'keychainId'=>$row["keychainId"],
                'borrowDate'=>$row["borrowDate"],
                'dueDate'=>$row["dueDate"],
                'returnDate'=>$row["returnDate"],
                'lostDate'=>$row["lostDate"],
                'comment'=>$row["comment"]
            ];

            array_push($borrowings, $borrowing);
        }

        return $borrowings;
    }

    public function addBorrow($borrow){
        $stmt = $this->pdo->prepare("INSERT INTO $this->_tableName
                                      (userEnssatPrimaryKey, keychainId, borrowDate, dueDate, returnDate, lostDate, comment)
                                      VALUES (:userEnssatPrimaryKey, :keychainId, :borrowDate, :dueDate, :returnDate, :lostDate, :comment)");

        $stmt->bindParam(':userEnssatPrimaryKey', $borrow['userEnssatPrimaryKey']);
        $stmt->bindParam(':keychainId', $borrow['keychainId']);
        $stmt->bindParam(':borrowDate', $borrow['borrowDate']);
        $stmt->bindParam(':dueDate', $borrow['dueDate']);
        $stmt->bindParam(':returnDate', $borrow['returnDate']);
        $stmt->bindParam(':lostDate', $borrow['lostDate']);
        $stmt->bindParam(':comment', $borrow['comment']);

        $stmt->execute();
    }

}

?>
