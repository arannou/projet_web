<?php

class LoseKeychainControllerForm {

    public $pageName;
    public $borrowing;

    public function __construct($pageName, $id){
        $this->pageName = $pageName;
        $this->borrowing = $id;
    }

    /**
     * Get the value of Page Name
     *
     * @return mixed
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * Set the value of Page Name
     *
     * @param mixed pageName
     *
     * @return self
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;

        return $this;
    }

}