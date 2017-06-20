<?php

class HomeController {

    public $pageName;
    public $keychains;
    public $borrowings;
    public $lateBorrowings;
    public $lostBorrowings;
	
    public $keysNumber;
	public $userNumber;
	public $borrowingsNumber;
	public $borrowingsThisWeek;

    private $userDAO;

    public function __construct($pageName){
        $this->pageName   = $pageName;
        $borrowService    = implementationBorrowService_Dummy::getInstance();
        $this->userDAO    = implementationUserDAO_Dummy::getInstance();

        $this->borrowings = $borrowService->getCurrentBorrowings();
        $this->lateBorrowings = $borrowService->getLateBorrowing();
        $this->lostBorrowings = $borrowService->getLostBorrowing();
		
		$users =implementationUserDAO_Dummy::getInstance();
		$this->userNumber = count($users->getUsers());
		
		$keys =implementationKeyDAO_Dummy::getInstance();
		$this->keysNumber = count($keys->getKeys());
		
		$borrowings =implementationBorrowingsDAO_Session::getInstance();
		$this->borrowingsNumber = count($borrowings->getBorrowings());
		$this->borrowingsThisWeek =0;
		foreach($borrowings->getBorrowings() as $b) {
			$firstDateTimeStamp = $b['borrowDate']->format("U");
    		$secondDateTimeStamp = (strtotime('last saturday'));
    		$rv = round ((($firstDateTimeStamp - $secondDateTimeStamp))/86400);
			if($rv>=0) $this->borrowingsThisWeek++;
		}
		
		
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
