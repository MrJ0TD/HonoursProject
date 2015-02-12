<?php
require 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

$data = $user->data();



?>


<html>
<head>
  <title>Action</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="jqueryajax.js"></script>
</head>
<body>
  <div class="row">
  <div id="post" class="col-lg-10 ">  
    
    <?php
    $post = DB::getInstance()->get('post' , array('genre_id', '=', '1'));
	foreach($post->results() as $post) {
		echo "<h1 class='text-center'>" .$post->post_title ."</h1>";
		echo "<p class='text-center'>" .$post->post_body ."</p>";

	}
 ?>
</div>
     </div>


   <div class="comment-block">
    <div class=".col-sm-6">
    <?php 
    $user = new User();
$comment = DB::getInstance()->query("SELECT * FROM comment WHERE post_id = '1' ORDER BY date_added DESC");
?>

<div class='comment'>
  <?php
if(!$comment->count()){
  echo 'No Comments at this time, be the first!';
} else {
  
  foreach($comment->results() as $comment) {

    echo " <div class='well'>
    <a id='name' href = 'profile.php?user=".$comment->username ."'>" .$comment->username ."</a></p><p class='said'>Said...</p><p id='comment'>". escape($comment->comment) ."</p> ";
    if($data->username == $comment->username){
 echo" <input type='button' id=".$comment->comment_id." class='delete-btn' data-username='".$comment->username."' value='Delete'></br> ";
      }
 echo"</div>";   } 
  }


    ?>
    </div>
  </div>
</div>
  <!-- comment form -->
  <div id="input-form">
  <form id="form"  method="post">
 
    <input type="hidden" name="postid" id="postid" value="1">
    <label>
   <input type="hidden" name="username" id="username" value="<?php echo escape($data->username); ?>">
  Username: <?php echo escape($data->username); ?>
    </label>
</br>
    <label>
      <span>Your comment *</span>
      <textarea name="comment" id="comment" required="true" cols="30" rows="10" placeholder="Type your comment here...." required></textarea>
    </label>
</br>
    <input type="submit" id="submit" value="Submit Comment">
  </form>
  </div>
  
</body>
</html>
