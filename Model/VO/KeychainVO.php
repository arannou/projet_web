<?php
class KeychainVO
{

    protected $id;
    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    protected $creationDate;
    public function setCreationDate($date)
    {
        $this->creationDate=$date;
    }
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    protected $destructionDate;
    public function setDestructionDate($date)
    {
        $this->destructionDate=$date;
    }
    public function getDestructionDate()
    {
        return $this->destructionDate;
    }

    protected $keysIds = [];
    public function setKeysIds($keysIds){
        $this->keysIds = $keysIds;
    }
    public function addKeyId($keyId)
    {
        array_push($this->$keysIds, $keyId);
    }
    public function getKeysIds()
    {
        return $this->keysIds;
    }

}
