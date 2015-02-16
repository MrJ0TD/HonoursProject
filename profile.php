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
  <link rel="stylesheet" type="text/css" href="bootstrap/css/style.css">
<script src="jqueryajax.js"></script>
</head>


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

	$default = '<img src="profile_default.jpg" width=200 height=200>';
	$image = '<img src="get.php" width=200 height=200>';
// 	$image = DB::getInstance()->query("SELECT * FROM users WHERE id = ".$data->id."" );
// 	foreach($image->results() as $image) {
// 	$mime = "image/jpeg";
// 	$b64Src = "data:".$mime.";base64," . base64_encode($image->img);
// 	echo '<img src="'.$b64Src.'" alt="" width=200 height=200/>', '<br>';
// }
	if(!$data->img_name){
		echo($default);
	} else{
		echo($image);
	}
	?>
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
				 
				<li><a href="#">Contact</a></li>
			</ul>
		</div>
		</div>
	</div>
   </nav>
   <div class="container">
   <div class="row">
<h3>Username:<?php echo escape($data->username); ?></h3>
<p>Full name: <?php echo escape($data->name); ?></p>
<p>About:</br> <?php echo escape($data->about); ?></p>
</div>
</div>
	<?php
}