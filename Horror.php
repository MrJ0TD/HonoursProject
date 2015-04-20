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
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GamerLocator</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/style.css">
<script src="jqueryajax.js"></script>
<script>
$(document).ready(function(){
    $(this).scrollTop(0);
});
</script>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top" >
  
          <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
      
    <div class="container-fluid">
      
    <div>
      <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right" >
        <li><a href="index.php">Home</a></li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">View Genres for Conversation <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="Action.php">Action</a></li>
            <li><a href="Fighting.php">Fighting</a></li>
            <li class="active"><a href="Horror.php">Horror</a></li>
            <li><a href="Sci-Fi.php">Sci-Fi</a></li>
            <li><a href="MMO.php">MMO</a></li>
            <li><a href="FPS.php">FPS</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">View Gaming Platforms<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="playstation.php">Playstation</a></li>
            <li><a href="xbox.php">Xbox</a></li>
            <li><a href="nintendo.php">Nintendo</a></li>
            <li><a href="pc.php">PC</a></li>
            
          </ul> 
        <li><a href="pm.php">View messages</a></li>  
        
      </ul>
    </div>
    </div>
  </div>
   </nav>
  <div class="row">
  <div id="post" class="col-lg-10 ">  
    
    <?php
    $post = DB::getInstance()->get('post' , array('genre_id', '=', '3'));
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
    
//  $image = DB::getInstance()->query("SELECT * FROM users WHERE id = ".$data->id."" );
//  foreach($image->results() as $image) {
//  $mime = "image/jpeg";
//  $b64Src = "data:".$mime.";base64," . base64_encode($image->img);
//  echo '<img src="'.$b64Src.'" alt="" width=200 height=200/>', '<br>';
// }
  
$comment = DB::getInstance()->query("SELECT * FROM comment WHERE post_id = '3' ORDER BY date_added DESC LIMIT 10");

if(!$comment->count()){
  echo 'No Comments at this time, be the first!';
} else {
  echo "<div id='comment'>";

  foreach($comment->results() as $comment) {
$default = '<img src="profile_default.jpg" width=100 height=100>';
    $image = '<img src="'. $comment->filepath .'" class="img-circle" width=100 height=100>';
      echo " <div class='well'>";
      echo "<div class='row'>";
      echo "<div class='col-md-1'>";
if(!$comment->filepath){
    echo($default);
  } else{
    echo($image);
  }
  echo '</div>';

  
  echo "<div class='col-md-3'>";
  echo  "</br><a id='name' href = 'profile.php?user=".$comment->username ."'>" .$comment->username ."</a> Said...</p><p id='comment'>". escape($comment->comment) ."</p> ";
    if($data->username == $comment->username){
 echo"<button class='btn btn-default btn-primary' id=".$comment->comment_id." data-username='".$comment->username."' name ='delete-btn' type='submit'>Delete</button>";
      }
 echo"</div>"; 
 echo "</div>";
   echo '</div>';
  } 
  }
  


    ?>
    </div>
  </div>
</div>
  <!-- comment form -->
  <div id="input-form">
  <form id="form"  method="post">
 
    <input type="hidden" name="postid" id="postid" value="3">
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
   <a href="#post"><input type="submit" id="submit" value="Submit Comment"></a>
  </form>
  </div>
  </br>
  </br>
  </br>
  </br>
  
  <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
            <div class="navbar-text pull-left" id="author">
		<p class="text-muted">&copy; Joshua McGregor 2015</p>
            </div>
            
            </div>
        </div>
  
</body>
</html>