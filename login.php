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
<?php 
require_once 'core/init.php';
$user = new User();
if($user->isLoggedIn()) {
	Redirect::to('index.php');
}
if(Input::exists()){
	if(Token::check(Input::get('token'))){

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true)

		));

		if($validation->passed()) {
			$user = new User();

			$remember = (Input::get('remember') === 'on') ? true : false;
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);

			if($login) {
				Redirect::to('index.php');
			} else {
				echo '<p>Sorry, you appear to be a bogus gas man!</p>';
			}

		} else {
			foreach($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}

	}
}

?>
<div class="container">

<div class="jumbotron">
  <h1>Gamerlocator</h1> 
 </div>


<div class="row">
  <div class="col-md-12">
    
	<h2>Looking for a way to find poeple to play some of your favourite games with? Then look no more! Gamerlocator is a simple app that will help you find gamers to play with via game genres.</h2>
    
  </div>
</div>


    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            
            <div class="account-wall">
            	<h1 class="text-center login-title">Sign in to continue to Gamerlocator</h1>    
                <form class="form-signin" action="" method="post">
                <input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="username" required autofocus>
                <input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Password" required>
                <input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                <label class="checkbox pull-left">
                <input type="checkbox" name="remember" id="remember" >
                    Remember me
                </label>
                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="register.php" class="text-center new-account">Create an account </a>
        </div>
    </div>
</div>

