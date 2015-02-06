<?php

  if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )):
  require 'core/init.php';

 if (isset($_POST["comment_id"]) ) {
  $comment_id = $_POST["comment_id"];
 
  
 if(Input::exists()){
  
      try{ 
        // I have to check if these variables are not null or exist. I.E. '$sub'
     $delete = DB::getInstance()->delete('comment', array("comment_id", "=", "$comment_id"));
    }  catch(Exception $e) {
        die($e->getMessage());
      }  

    } 
  }
 else {
  return false;
 }
endif?>