<?php
require 'core/init.php';

if(Session::exists('home')) {
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new user(); 
if($user->isLoggedIn()) {
	
?>
	<p>Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</p>

	<ul>
		<li><a href="genre.php">View Genres for Conversations</a></li>
		<li><a href="update.php">Update details</a></li>
		<li><a href="changepassword.php">Change Password</a></li>
		<li><a href="logout.php">Log Out</a></li>
	</ul>


<?php 
if($user->hasPermission('admin')){
		echo '<p>Evening Admin</p>';
}

} else {
		echo '<p>You need to <a href="login.php">log in</a> or get <a href="register.php">registered</a> son!!</p>';
	}



?>