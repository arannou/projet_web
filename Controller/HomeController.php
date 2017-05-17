<?php

class HomeController {

    public $pageName;
    public $keychains;
    public $borrowings;

    public $keys;

    public function __construct($pageName){
        $this->pageName = $pageName;
        $DAO = implementationKeychainDAO_Dummy::getInstance();
        $this->keychains = $DAO->getKeychains();

        $borrowService    = implementationBorrowService_Dummy::getInstance();
        $this->borrowings = $borrowService->getBorrowings();

        foreach ($this->borrowings as $key => $borrowing) {
            $this->borrowings[$key]['status'] = $borrowService->getBorrowingStatus($borrowing['borrowingId']);
        }


      /*  $keysDAO= implementationKeyDAO_Dummy::getInstance();
        $this->keys=$keysDAO->getKeys();
*/
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
