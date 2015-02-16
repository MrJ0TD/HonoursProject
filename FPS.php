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
        <li class="active"><a href="index.php">Home</a></li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">View Genres for Conversation <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="Action.php">Action</a></li>
            <li><a href="Fighting.php">Fighting</a></li>
            <li><a href="Horror.php">Horror</a></li>
            <li><a href="Sci-Fi.php">Sci-Fi</a></li>
            <li><a href="MMO.php">MMO</a></li>
            <li class="active"><a href="FPS.php">FPS</a></li>
          </ul>
        </li> 
         
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
    </div>
  </div>
   </nav>
  <div class="row">
  <div id="post" class="col-lg-10 ">  
    
    <?php
    $post = DB::getInstance()->get('post' , array('genre_id', '=', '6'));
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
    $default = '<img src="profile_default.jpg" width=100 height=100>';
  $image = '<img src="get.php" width=200 height=200>';
//  $image = DB::getInstance()->query("SELECT * FROM users WHERE id = ".$data->id."" );
//  foreach($image->results() as $image) {
//  $mime = "image/jpeg";
//  $b64Src = "data:".$mime.";base64," . base64_encode($image->img);
//  echo '<img src="'.$b64Src.'" alt="" width=200 height=200/>', '<br>';
// }
  
$comment = DB::getInstance()->query("SELECT * FROM comment WHERE post_id = '6' ORDER BY date_added DESC");

if(!$comment->count()){
  echo 'No Comments at this time, be the first!';
} else {
  echo "<div id='comment'>";
  foreach($comment->results() as $comment) {

      echo " <div class='well'>";
if(!$data->img_name){
    echo($default);
  } else{
    echo($image);
  }
  echo  "</br><a id='name' href = 'profile.php?user=".$comment->username ."'>" .$comment->username ."</a></p><p class='said'>Said...</p><p id='comment'>". escape($comment->comment) ."</p> ";
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
 
    <input type="hidden" name="postid" id="postid" value="6">
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
