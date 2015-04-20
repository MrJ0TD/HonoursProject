<?php
require_once 'core/init.php';

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
				'username' => array(
					//'name' => 'username';
						'required'=> true,
						'min' => 2,
						'max' => 20,
						'unique' => 'users'
					),
				'password' => array(
						'required'=> true,
						'min' => 6,
						
					),
				'password_again' => array(
						'required'=> true,
						'matches'=>'password'
					),
				'name' => array(
						'required'=> true,
						'min' => 2,
						'max' => 50
					)
			));

		if($validation->passed()){
			$user = new user();

			$salt = Hash::salt(32);
			$console = "";
			foreach ( $_POST['console'] as $con )
				{
				    $console .=   $con . ' ' ;
				}

			try {

				$user->create(array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'name' => Input::get('name'),
					'joined' => date('Y-m-d H:i:s'),
					'group' => 1,
					'console' => $console	
					));

				Session::flash('home', 'You have been registered!');
				Redirect::to('login.php');


			} catch(Exception $e){
				die($e->getMessage());
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
<div class="container">


<div class="row">
  <div class="col-md-12">
    
	<h2>Get Registered!</h2>
</br>
    
  </div>
</div>


 <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">

<form action="" method="post">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" class="textbox" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
	</div>
<br>
	<div class="field">
		<label for="password">Make a Password</label>
		<input type="password" class="textbox" name="password" id="password">
	</div>
<br>
	<div class="field">
		<label for="password_again">Repeat your Password</label>
		<input type="password"class="textbox"  name="password_again" id="password_again">
	</div>
<br>
	<div class="field">
		<label for="name">Enter your Name</label>
		<input type="text" class="textbox" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name">	
	</div>
	
<br>
	<div id="checkboxes">
	<div class="field" >
		<label for="console">Please select your favourite gaming platform</label>
				 <label class="checkbox-inline">
		  <input type="checkbox" name="console[]" value="Xbox"> Xbox
		</label>
		<label class="checkbox-inline">
		  <input type="checkbox" name="console[]" value="Playstation"> Playstation
		</label>
		<label class="checkbox-inline">
		  <input type="checkbox" name="console[]" value="Nintendo"> Nintendo
		</label>
		<label class="checkbox-inline">
		  <input type="checkbox" name="console[]" value="PC"> PC
		</label>
			</div>
			</div>
	
<br>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" >
	 <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Register</button>
</form>
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