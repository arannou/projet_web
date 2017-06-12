<?php

class HomeController {

    public $pageName;
    public $keychains;
    public $borrowings;
    public $lateBorrowings;
    public $lostBorrowings;
    public $keys;

    private $userDAO;

    public function __construct($pageName){
        $this->pageName   = $pageName;
        $borrowService    = implementationBorrowService_Dummy::getInstance();
        $this->userDAO    = implementationUserDAO_Dummy::getInstance();

        $this->borrowings = $borrowService->getCurrentBorrowings();
        $this->lateBorrowings = $borrowService->getLateBorrowing();
        $this->lostBorrowings = $borrowService->getLostBorrowing();
    }

    public function getDeltaInDays($lateBorrowing){
        return date_diff($lateBorrowing['dueDate'], new DateTime())->days;
    }

    public function getUserNameByEnssatPrimaryKey($epk){
        $user = $this->userDAO->getUserByEnssatPrimaryKey($epk);
        return $user->getSurname()." ".$user->getName();
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
