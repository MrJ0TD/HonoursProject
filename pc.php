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
            <li><a href="Horror.php">Horror</a></li>
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
            <li class="active"><a href="pc.php">PC</a></li>
            
          </ul>
        </li> 
         <li><a href="pm.php">View messages</a></li>  
      </ul>
    </div>
    </div>
  </div>
   </nav>
   <div class="container-fluid">
  <div class="row">
  <div id="post" class="col-lg-10 ">  
    
   <h1 class='text-center'>Xbox</h1>
	<p class='text-center'>Below is a list of Users who all love the PC!</p>
</div>
     </div>


 
     <?php 
      
$users = DB::getInstance()->query("SELECT * FROM users WHERE console LIKE '%PC%'");

if(!$users->count()){
  echo 'Nobody seems to like the PC!';
} else {
 
  foreach($users->results() as $users) {
$default = '<img src="profile_default.jpg" width=100 height=100>';
    $image = '<img src="'. $users->filepath .'" class="img-circle" width=100 height=100>';
    echo " <div class='well'>";
    echo "<div class='row'>";
    	echo "<div class='col-md-4'>";
      
      
if(!$users->filepath){
    echo($default);
  } else{
    echo($image);
  }
  echo "</div>";   
 echo"</div>";
 echo "<div class='row'>";
  echo "<div class='col-md-8'>";
  echo  "<h3><a id='name' href = 'profile.php?user=".$users->username ."'>" .$users->username ."</a></h3>";
 echo "</div>";
 echo "</div>";   
 echo"</div>";  
 
  } 
  }
  


    ?>
    
  
</div>
  <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
            <div class="navbar-text pull-left" id="author">
		<p class="text-muted">&copy; Joshua McGregor 2015</p>
            </div>
            
            </div>
        </div>
</body>
</html>