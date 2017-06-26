<?php
class KeychainVO
{
    /**
     * @var identifiant du trousseau
     */
    protected $id;

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
     * @var date de creation du trousseau
     */
    protected $creationDate;

    /**
     * @param $date
     */
    public function setCreationDate($date)
    {
        $this->creationDate=$date;
    }

    /**
     * @return date
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @var date de destruction du trousseau
     */
    protected $destructionDate;

    /**
     * @param $date
     */
    public function setDestructionDate($date)
    {
        $this->destructionDate=$date;
    }

    /**
     * @return date
     */
    public function getDestructionDate()
    {
        return $this->destructionDate;
    }


    /**
     * @var array Clés du trousseau
     */
    protected $keys = [];

    /**
     * @return array
     */
    public function getKeys(){
        return $this->keys;
    }

    /**
     * @param $keys
     */
    public function setKeys($keys){
        $this->keys = $keys;
    }

    /**
     * @param $key
     */
    public function addKey($key){
        array_push($keys, $key);
    }
}
