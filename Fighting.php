<?php
require 'core/init.php';
$user = new User();

if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}
?>

<html>
<head>
  <title>Action</title>
<head>
<body>
  <div class="post">
    <?php
    $post = DB::getInstance()->get('post' , array('genre_id', '=', '2'));
	foreach($post->results() as $post) {
		echo "<h1>" .$post->post_title ."</h1>";
		echo "<p>" .$post->post_body ."</p>";

	}
 ?>

  </div>
  
</body>
</html>






