<?php
require 'core/init.php';
if (!empty($_POST['name']) AND !empty($_POST['mail']) AND !empty($_POST['comment']) AND !empty($_POST['postid'])) {
    $username = ($_POST['username']);
    $comment = ($_POST['comment']);
    $postid = ($_POST['postid']);
 
  
 if(Input::exists()){
  
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'comment' => array(
          //'name' => 'username';
            'required'=> true,
            'min' => 2,
            'max' => 350,
            'unique' => 'comment'
          )
        ));

    if($validation->passed()){
      $comment = DB::getInstance()->insert('comment', array(
          'username' => '$username',
          'comment' => '$comment',
          'post_id' => '$postid'
        ));
    }   
  }
}
?>

<div class="comment-item">
  <div class="comment-post">
   <h3><a href="profile.php?user=<?php echo $username ?>"<?php echo $username ?>></a> <span>said....</span></h3>
    <p><?php echo $comment ?></p>
  </div>
</div>

