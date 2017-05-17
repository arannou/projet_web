<?php

class HomeController {

    public $pageName;
    public $keychains;
    public $borrowings;

    public $keys;

    public function __construct($pageName){
        $this->pageName   = $pageName;
        $borrowService    = implementationBorrowService_Dummy::getInstance();
        $this->borrowings = $borrowService->getBorrowingsWithStatus();
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
