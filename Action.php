<?php
require 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

$data = $user->data();



?>
helllooo

<html>
<head>
  <title>Action</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="jqueryajax.js"></script>
</head>
<body>
  <div class="post">
    <?php
    $post = DB::getInstance()->get('post' , array('genre_id', '=', '1'));
	foreach($post->results() as $post) {
		echo "<h1>" .$post->post_title ."</h1>";
		echo "<p>" .$post->post_body ."</p>";

	}
 ?>

  </div>

   <div class="comment-block">
    <!-- comment will be apped here from db-->
  </div>
  <!-- comment form -->
  <form id="form" action="comment.php" method="post">
 
    <input type="hidden" name="postid" id="postid" value="1">
    <label>
      Username: <p style="display:inline" id="username"><?php echo escape($data->username); ?></p>
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
