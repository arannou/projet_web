<?php

class BorrowKeyChainFormController {

    public $pageName;
    public $keychains;
    public $borrowings;

    public function __construct($pageName){
        $this->pageName = $pageName;
        $DAO = implementationKeychainDAO_Dummy::getInstance();
        $this->keychains = $DAO->getKeychains();

        $borrowService    = implementationBorrowService_Dummy::getInstance();
        $this->borrowings = $borrowService->getBorrowings();

        $borrowService->returnKeychain(1, "All is ok"); //

        foreach ($this->borrowings as $key => $borrowing) {
            $this->borrowings[$key]['status'] = $borrowService->getBorrowingStatus($borrowing['borrowingId']);
        }

        $DAO = implementationUserDAO_Dummy::getInstance();
        $this->users = $DAO->getUsers();

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
