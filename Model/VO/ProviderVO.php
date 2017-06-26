<?php
class ProviderVO
{

    /**
     * @var Identifiant du fournisseur
     */
    protected $id;

    /**
     * @var username
     */
    protected $username;

    /**
     * @var nom
     */
    protected $name;

    /**
     * @var nom de famille
     */
    protected $surname;

    /**
     * @var telephone
     */
    protected $phone;

    /**
     * @var bureau
     */
    protected $office;

    /**
     * @var adresse email
     */
    protected $email;

    /**
     * @param $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return Identifiant
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @return username
     */
    public function getUsername() {
        return $this->username;
    }

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
     * @param $office
     */
    public function setOffice($office) {
        $this->office = $office;
    }

    /**
     * @return bureau
     */
    public function getOffice() {
        return $this->office;
    }

    /**
     * @param $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return adresse
     */
    public function getEmail() {
        return $this->email;
    }
}
