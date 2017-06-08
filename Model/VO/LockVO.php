<?php
class LockVO
{
    protected $id;
    protected $length;
    protected $doorId;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setLength($length) {
        $this->length = $length;
    }

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

}
