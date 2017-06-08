<?php
class KeyVO
{

    public static $keyType = array("Simple"=>"Clé","Partiel"=>"Passe Partiel","Total"=>"Passe Total");


    protected $id;
    protected $type; //Clef ou Passe Partiel ou Passe Total
    protected $keychainId = null;
    protected $lockId;

    /**
     * Get the value of Key Type
     *
     * @return mixed
     */
    public function getKeyType()
    {
        return $this->keyType;
    }

    /**
     * Set the value of Key Type
     *
     * @param mixed keyType
     *
     * @return self
     */
    public function setKeyType($keyType)
    {
        $this->keyType = $keyType;

        return $this;
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Type
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of Type
     *
     * @param mixed type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
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

    /**
     * Get the value of Lock Id
     *
     * @return mixed
     */
    public function getLockId()
    {
        return $this->lockId;
    }

    /**
     * Set the value of Lock Id
     *
     * @param mixed lockId
     *
     * @return self
     */
    public function setLockId($lockId)
    {
        $this->lockId = $lockId;

        return $this;
    }

}
