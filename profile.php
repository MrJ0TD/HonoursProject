<?php
require_once 'core/init.php';

if(!$username = Input::get('user')) {
	Redirect::to('index.php');
} else {
	$user = new User($username);
	if(!$user->exists()) {
		Redirect::to(404);
	} else{
		$data = $user->data();
	}
	$user = new user();
	?>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GamerLocator</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">


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
        </li> 
				<li><a href="pm.php">View messages</a></li>  
				
			</ul>
		</div>
		</div>
	</div>
   </nav>
   <div class="container">
   <div class="row">
   <div class="col-md-3">
<?php


	$default = '<img src="profile_default.jpg" class="img-rounded" width=200 height=200>';
	$image = '<img src="'. $data->filepath .'" class="img-circle" width=200 height=200>';
// 	$image = DB::getInstance()->query("SELECT * FROM users WHERE id = ".$data->id."" );
// 	foreach($image->results() as $image) {
// 	$mime = "image/jpeg";
// 	$b64Src = "data:".$mime.";base64," . base64_encode($image->img);
// 	echo '<img src="'.$b64Src.'" alt="" width=200 height=200/>', '<br>';
// }

	
	?>
	
 
 
   <?php 
   if(!$data->filepath){
   		
		echo($default);
		
	} else{
		
		echo($image);
		
	}
   
   
   ?>
   </div>
   </div>
   <div class="row">
   <div class="col-md-3" id="details">
<h3>Username:</br><?php echo escape($data->username); ?></h3>
<p>Full name: <?php echo escape($data->name); ?></p>
<?php if(!$data->console){
	echo $data->username . " has not yet chosen their favourite gaming platforms. </br>";
} else{
	echo $data->username . "'s favourite gaming platform(s) are:";
	$console =  explode( ' ', $data->console ) ;
	$space = array_pop($console);
	foreach ($console as $con){
	echo "<li><a href=".strtolower($con).".php>".$con."</a></li> ";
}
}
?>
</br>
<?php if($data->username !== $user->data()->username){
	echo"<a href='message.php?user=".$data->username."'>Send them a message!</a>";
}
?>
</div>

<div class="col-md-8" id="about">
<h3 class="about">About:</h3><p> <?php echo escape($data->about); ?></p>


</div>
</div>
</div>
 <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
            <div class="navbar-text pull-left" id="author">
		<p class="text-muted">&copy; Joshua McGregor 2015</p>
            </div>
            
            </div>
        </div>
	<?php
}