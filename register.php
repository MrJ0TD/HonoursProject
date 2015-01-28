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
			

			try {

				$user->create(array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'name' => Input::get('name'),
					'joined' => date('Y-m-d H:i:s'),
					'group' => 1	
					));

				Session::flash('home', 'You have been registered!');
				Redirect::to('index.php');


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
<form action="" method="post">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
	</div>
<br>
	<div class="field">
		<label for="password">Make a Password</label>
		<input type="password" name="password" id="password">
	</div>
<br>
	<div class="field">
		<label for="password_again">Repeat your Password</label>
		<input type="password" name="password_again" id="password_again">
	</div>
<br>
	<div class="field">
		<label for="name">Enter your Name</label>
		<input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name">	
	</div>
<br>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" >
	<input type="submit" value="Register">
</form>