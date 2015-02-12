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
	
	$mime = "image/jpeg";
	$b64Src = "data:".$mime.";base64," . base64_encode($data->img);
	echo '<img src="'.$b64Src.'" alt="" width=200 height=200/>', '<br>';
	
	?>

<h3>Username:<?php echo escape($data->username); ?></h3>
<p>Full name: <?php echo escape($data->name); ?></p>
<p>About:</br> <?php echo escape($data->about); ?></p>

	<?php
}