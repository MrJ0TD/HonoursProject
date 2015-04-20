<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
				'password_current' => array(
					'required' => true,
					'min' => 6,
					),
				'password_new' => array(
					'required' => true, 
					'min' => 6
					),
				'password_new_again' => array(
					'required' => true, 
					'min' => 6,
					'matches' => 'password_new'
					)
			));

		if($validation->passed()) {

			if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
				echo 'Your current password is wrong!!';
			} else {
				$salt= Hash::salt(32);
				$user->update(array(
						'password' => Hash::make(Input::get('password_new'), $salt),
						'salt' => $salt
					));

				Session::flash('home', 'Your password has been changed!');
				Redirect::to('index.php');
			}

		} else {
			foreach($validation->errors() as $error){
				echo $error, '<br>';
			}
		}

	}
}
?>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GamerLocator</title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">


</head>
<body>
</br>
</br>
</br>
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
            <li class="active"><a href="Action.php">Action</a></li>
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
	<div class="container">


<div class="row">
  <div class="col-md-12">
    
	<h2>Change your password!</h2>
</br>
    
  </div>
</div>


 <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">

<form action="" method="post">
	<div class="field">
		<label for ="password_current">Current Password:</label>
			<input type="password" class="textbox" name="password_current" id="password_current">
	</div>
	</br>
	</br>
	<div class="field">
		<label for ="password_new">New Password:</label>
			<input type="password" class="textbox" name="password_new" id="password_new">
	</div>
	</br>
	</br>
	<div class="field">
		<label for ="password_new_again">Re-enter Password:</label>
			<input type="password" class="textbox" name="password_new_again" id="password_new_again">
	</div>
	</br>
	<button class="btn btn-lg btn-primary btn-block" type="submit">
                    Change</button>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>

<div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
            <div class="navbar-text pull-left" id="author">
		<p class="text-muted">&copy; Joshua McGregor 2015</p>
            </div>
            
            </div>
        </div>