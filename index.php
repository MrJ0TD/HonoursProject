<?php
require 'core/init.php';
require 'steamauth/steamauth.php';
if(Session::exists('home')) {
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new user(); 
if($user->isLoggedIn()) {
	
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

  <?php if($user->isLoggedIn()){
  ?>
   		<h1 >Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</h1>

	<ul class="nav nav-pills nav-stacked">
		
		<li li role="presentation"><a href="update.php">Update details</a></li>
		<li li role="presentation"><a href="pm.php">View your private messages</a></li>
		<li li role="presentation"><a href="changepassword.php">Change Password</a></li>
		<li li role="presentation"><a href="logout.php">Log Out</a></li>
	</ul>
	</div>
<?php
} else if(isset($_SESSION['steamid'])){
?>
	<h1 >Hello <a href="profile.php?user=<?php echo escape($steamprofile['personaname']); ?>"><?php echo escape($steamprofile['personaname']); ?></a>!</h1>

	<ul class="nav nav-pills nav-stacked">
		
		<li li role="presentation"><a href="update.php">Update details</a></li>
		<li li role="presentation"><a href="pm.php">View your private messages</a></li>
		<li li role="presentation"><a href="changepassword.php">Change Password</a></li>
		<li li role="presentation"><a href="logout.php">Log Out</a></li>
	</ul>
	</div>
	<?php
}
?>
</div>
<?php 
if($user->hasPermission('admin')){
		echo '<p>Evening Admin</p>';
}

} 
	
else {
		Redirect::to('login.php');
	}

?>

<div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
            <div class="navbar-text pull-left" id="author">
		<p class="text-muted">&copy; Joshua McGregor 2015</p>
            </div>
            
            </div>
        </div>
</body>
</html>