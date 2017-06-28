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
        $user = null;
        if($row != false) {
          $user = new UserVO();
          $user->setEnssatPrimaryKey($row["enssatPrimaryKey"]);
          $user->setUr1Identifier($row["ur1identifier"]);
          $user->setUsername($row["username"]);
          $user->setName($row["name"]);
          $user->setSurname($row["surname"]);
          $user->setPhone($row["phone"]);
          $user->setStatus($row["status"]);
          $user->setEmail($row["email"]);
        }

        return $user;
    }

    public function addUser($user){
        $stmt = $this->pdo->prepare("INSERT INTO $this->_tableName
                                      (ur1identifier, enssatPrimaryKey, name, username, surname, phone, status, email)
                                      VALUES (:ur1identifier, :enssatPrimaryKey, :name, :username, :surname, :phone, :status, :email)");

        $ur1identifier = $user->getUr1Identifier();
        $enssatPrimaryKey = $user->getEnssatPrimaryKey();
        $name = $user->getName();
        $username = $user->getUsername();
        $surname = $user->getSurname();
        $phone = $user->getPhone();
        $status = $user->getStatus();
        $email = $user->getEmail();

        $stmt->bindParam(':ur1identifier', $ur1identifier);
        $stmt->bindParam(':enssatPrimaryKey', $enssatPrimaryKey);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        echo '<br><br>';
    }

}


?>
