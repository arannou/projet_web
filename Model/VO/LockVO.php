<?php
class LockVO
{
    /**
     * @var identifiant du canon
     */
    protected $id;

    /**
     * @var taille du canon
     */
    protected $length;

    /**
     * @var Identifiant de la porte
     */
    protected $doorId;

    /**
     * @var identifiant du fournisseur
     */
    protected $provider;

    /**
     * @param $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return identifiant
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param $length
     */
    public function setLength($length) {
        $this->length = $length;
    }

    /**
     * @return taille
     */
    public function getLength() {
        return $this->length;
    }

    /**
     * Get the value of Door Id
     *
     * @return mixed
     */
    public function getDoorId()
    {
        return $this->doorId;
    }

    /**
     * Set the value of Door Id
     *
     * @param mixed doorId
     *
     * @return self
     */
    public function setDoorId($doorId)
    {
        $this->doorId = $doorId;

        return $this;
    }

    /**
     * @param $provider
     */
    public function setProvider($provider) {
        $this->provider = $provider;
    }

    /**
     * @return identifiant
     */
    public function getProvider() {
        return $this->provider;
    }
}
