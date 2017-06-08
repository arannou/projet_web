<?php

class keychainReturnValiderController {

  //  public $id;

   public function __construct($id){

//     if(isset($_POST['id']) && isset($_POST['comment'])){
 	//		echo "id: ".$_POST['id'].", comment: ".$_POST['comment'];
 			$borrowService= implementationBorrowService_Dummy::getInstance();
 			$borrowService->returnKeychain((int)$id,"ok");
 		//}

     /*
      $this->id = $id;
        $borrowService    =implementationBorrowService_Dummy::getInstance();
  $borrowService->returnKeychain((int)$id, "ok");*/

    //    $borrowService->returnKeychain((int)$id,"ok");
    }




/*
  public function __construct($pageName){

$borrowService    = implementationBorrowService_Dummy::getInstance();
    $borrowService->returnKeychain($_POST['borrowingId'],"ok");
  } */

}
