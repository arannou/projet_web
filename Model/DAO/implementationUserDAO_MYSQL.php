<?php
require_once 'Model/VO/UserVO.php';
require_once 'Model/DAO/interfaceUserDAO.php';
require_once 'Model/DAO/ImplementationDAO_MYSQL.php';


// Implémentation de l'interface
// Ceci va fonctionner
class implementationUserDAO_MYSQL extends implementationDAO_MYSQL implements interfaceUserDAO
{
    /**
     * @var Singleton
     * @access private
     * @static
     */
    private static $_instance = null;
    private $_tableName       = "user";

    /**
     * Constructeur de la classe
     *
     * @param void
     * @return void
     */
    private function __construct() {
        parent::initDb();
    }

    public function populate(){
        if (file_exists(dirname(__FILE__).'/users.xml')) {
            $users = simplexml_load_file(dirname(__FILE__).'/users.xml');
            foreach($users->children() as $xmlUser)
            {
                $user = new UserVO;
                $user->setEnssatPrimaryKey((int) $xmlUser->enssatPrimaryKey);
                $user->setUr1Identifier((int)$xmlUser->ur1identifier);
                $user->setUsername((string)$xmlUser->username);
                $user->setName((string)$xmlUser->name);
                $user->setSurname((string)$xmlUser->surname);
                $user->setPhone((string)$xmlUser->phone);
                $user->setStatus((string)$xmlUser->status);
                $user->setEmail((string)$xmlUser->email);

                $this->addUser($user);
            }
        } else {
            throw new RuntimeException('Echec lors de l\'ouverture du fichier users.xml.');
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
            self::$_instance = new implementationUserDAO_MYSQL();
        }

        return self::$_instance;
    }

    public function getUsers()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName");
        $stmt->execute();

        $users = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $user = new UserVO();

            $user->setEnssatPrimaryKey($row["enssatPrimaryKey"]);
            $user->setUr1Identifier($row["ur1identifier"]);
            $user->setUsername($row["username"]);
            $user->setName($row["name"]);
            $user->setSurname($row["surname"]);
            $user->setPhone($row["phone"]);
            $user->setStatus($row["status"]);
            $user->setEmail($row["email"]);

            array_push($users, $user);
        }

        return $users;
    }

    public function getUserByEnssatPrimaryKey($enssatPrimaryKey)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->_tableName WHERE enssatPrimaryKey = :enssatPrimaryKey");
        $stmt->bindParam("enssatPrimaryKey", $enssatPrimaryKey);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $user = new UserVO();
        $user->setEnssatPrimaryKey($row["enssatPrimaryKey"]);
        $user->setUr1Identifier($row["ur1identifier"]);
        $user->setUsername($row["username"]);
        $user->setName($row["name"]);
        $user->setSurname($row["surname"]);
        $user->setPhone($row["phone"]);
        $user->setStatus($row["status"]);
        $user->setEmail($row["email"]);

        return $user;
    }

    public function addUser($user){
        $stmt = $this->pdo->prepare("INSERT INTO $this->_tableName 
                                      ( name, username, surname, phone, status, email) 
                                      VALUES (:name, :username, :surname, :phone, :status, :email)");

        $stmt->bindParam(':name', $user->getName());
        $stmt->bindParam(':username', $user->getUsername());
        $stmt->bindParam(':surname', $user->getSurname());
        $stmt->bindParam(':phone', $user->getPhone());
        $stmt->bindParam(':status', $user->getStatus());
        $stmt->bindParam(':email', $user->getEmail());

        $stmt->execute();
    }

}


?>
