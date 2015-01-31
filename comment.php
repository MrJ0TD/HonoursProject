<?php

  if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )):
  require 'core/init.php';

 if (isset($_POST["username"]) && (isset($_POST["comment"]) && (isset($_POST["postid"]) ))) {
  $username = $_POST["username"];
  $sub = $_POST["comment"];
  $postid = $_POST["postid"];
 
  
 if(Input::exists()){
  $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'comment' => array(
            'required' => true,
            'min' =>2,
            'max' => 300
          )
      ));
    if($validation->passed()) {
      try{ 
        // I have to check if these variables are not null or exist. I.E. '$sub'
      $comment = DB::getInstance()->insert('comment', array(
          'username' => "$username",
          'comment' => "$sub",
          'post_id' =>"$postid"
        ));
    }  catch(Exception $e) {
        die($e->getMessage());
      }  

    } else{
      foreach($validation->errors() as $error) {
        echo $error, '<br>';
      }   
    }
  }

  

?>

<div class="comment-item">
  <div class="comment-post">
   
      <a href="profile.php?user=<?php echo $username ?>"><?php echo $username ?></a>
       <p>Said....</p>
  
    <p><?php echo $sub ?></p>
  </div>
</div>

<?php
 }else {
  return false;
 }
endif?>