<?php
class UserVO
{

    /**
     * @var Identifiant Rennes1
     */
    protected $ur1identifier; //code apogee ou harpege, selon statut

    /**
     * @param $id
     */
    public function setUr1Identifier($id) {
        $this->ur1identifier = $id;
    }

    /**
     * @return Identifiant
     */
    public function getUr1Identifier() {
        return $this->ur1identifier;
    }

    /**
     * @var Identifiant enssat
     */
    protected $enssatPrimaryKey; //32 bits

    /**
     * @param $id
     */
    public function setEnssatPrimaryKey($id) {
        $this->enssatPrimaryKey = $id;
    }

    /**
     * @return Identifiant
     */
    public function getEnssatPrimaryKey() {
        return $this->enssatPrimaryKey;
    }

    /**
     * @var Username
     */
    protected $username;

    /**
     * @param $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @return Username
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @var nom
     */
    protected $name;

    /**
     * @param $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return nom
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @var nom de famille
     */
    protected $surname;

    /**
     * @param $surname
     */
    public function setSurname($surname) {
        $this->surname = $surname;
    }

    /**
     * @return nom
     */
    public function getSurname() {
        return $this->surname;
    }

    /**
     * @var telephone
     */
    protected $phone;

    /**
     * @param $phone
     */
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    /**
     * @return telephone
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * @var statut de l'utilisateur
     */
    protected $status; //Etudiant, Exterieur, personel

    /**
     * @param $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * @return statut
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @var Adresse email
     */
    protected $email;

    /**
     * @param $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return Adresse
     */
    public function getEmail() {
        return $this->email;
    }
}
