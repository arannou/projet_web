<?php

class HomeController {

    public $pageName;
    public $keychains;
    public $borrowings;
    public $lateBorrowings;
    public $lostBorrowings;
	
    public $keysNumber;
    public $passNumber;
	public $userNumber;
	public $studentNumber;
	public $borrowingsNumber;
	public $lateNumber;
	public $borrowingsThisWeek;

    private $userDAO;
    private $keyKeychainDAO;
    private $lockDAO;

    public function __construct($pageName){
        $this->pageName   = $pageName;
        $borrowService    = implementationBorrowService::getInstance();
        $this->userDAO    = implementationUserDAO_Session::getInstance();

        $this->borrowings     = $borrowService->getCurrentBorrowings();
        $this->lateBorrowings = $borrowService->getLateBorrowing();
		$this->lateNumber     = count($borrowService->getLateBorrowing());
        $this->lostBorrowings = $borrowService->getLostBorrowing();

        $this->keyKeychainDAO = implementationKeyKeychainDAO_Session::getInstance();
        $this->lockDAO        = implementationLockDAO_Session::getInstance();
        $this->doorDAO        = implementationDoorDAO_Session::getInstance();
		
		// bloc 'nombre d'utilisateurs'
		$users =implementationUserDAO_Session::getInstance();
		$this->userNumber = count($users->getUsers());
		$this->studentNumber =0;
		foreach($users->getUsers() as $u) {
			if (strval($u->getStatus()) =="Etudiant")
			$this->studentNumber ++;
		}
		
		// bloc nombre de clés
		$keys =implementationKeyDAO_Session::getInstance();
		$this->keysNumber = count($keys->getKeys());
		$this->passNumber =0;
		foreach($keys->getKeys() as $k) {
			if (strval($k->getType()) !="Clé")
			$this->passNumber ++;
		}
		
		// bloc nombre d'emprunts
		$borrowings =implementationBorrowingsDAO_Session::getInstance();
		$this->borrowingsNumber = count($borrowings->getBorrowings());
		
		// bloc enmprunts en cours
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

    public function getKeysByKeychainId($kid){
        $keys = $this->keyKeychainDAO->getKeysByKeychainId($kid);
        $rooms = [];
        foreach ($keys as $key){
            $lock = $this->lockDAO->getLockById($key->getLockId());

            if($lock != null){
                $door = $this->doorDAO->getDoorById($lock->getDoorId());
                if($door != null){
                    array_push($rooms, $door->getRoomId());
                }
            }
        }

        return implode(', ', $rooms);
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
