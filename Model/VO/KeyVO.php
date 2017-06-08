<?php
class KeyVO
{

    public static $keyType = array("Simple"=>"Clé","Partiel"=>"Passe Partiel","Total"=>"Passe Total");

    protected $id;
    protected $type; //Clef ou Passe Partiel ou Passe Total
    protected $keychainId = null;


    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    /**
     * Get the value of Keychain Id
     *
     * @return mixed
     */
    public function getKeychainId()
    {
        return $this->keychainId;
    }

    /**
     * Set the value of Keychain Id
     *
     * @param mixed keychainId
     *
     * @return self
     */
    public function setKeychainId($keychainId)
    {
        $this->keychainId = $keychainId;

        return $this;
    }

}
