<?php

  if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )):
  require 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()) {
  Redirect::to('index.php');
}

$data = $user->data();


 if (isset($_POST["comment_id"]) && isset($_POST["username"]) ) {
  $comment_id = $_POST["comment_id"];
  $username = $_POST["username"];
 
  if($data->username == $username){
 
 if(Input::exists()){
    
      try{ 

        // I have to check if these variables are not null or exist. I.E. '$sub'
     $delete = DB::getInstance()->delete('comment', array("comment_id", "=", "$comment_id"));
    }  catch(Exception $e) {
        die($e->getMessage());
      }  

    } 
  
  }

  }
 else {
  return false;
 }
endif?>