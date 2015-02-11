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
<script src="jqueryajax.js"></script>
</head>
<body>
  <div class="post">
    <?php
    $post = DB::getInstance()->get('post' , array('genre_id', '=', '5'));
	foreach($post->results() as $post) {
		echo "<h1>" .$post->post_title ."</h1>";
		echo "<p>" .$post->post_body ."</p>";

	}
 ?>

  </div>

   <div class="comment-block">
    <?php 
$comment = DB::getInstance()->query("SELECT * FROM comment WHERE post_id = '5'");

if(!$comment->count()){
  echo 'No Comments at this time, be the first!';
} else {
  echo "<div id='comment'>";
  foreach($comment->results() as $comment) {

    echo "
    <a id='name' href = 'profile.php?user=".$comment->username ."'>" .$comment->username ."</a></p><p class='said'>Said...</p><p id='comment'>". $comment->comment ."</p> ";
    if($data->username == $comment->username){
 echo" <input type='button' id=".$comment->comment_id." class='delete-btn' value='Delete'></br></div> ";
}
} 
}


    ?>

  </div>
  <!-- comment form -->
  <form id="form"  method="post">
 
    <input type="hidden" name="postid" id="postid" value="5">
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
  
</body>
</html>