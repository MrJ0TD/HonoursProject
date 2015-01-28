<h1>Genre Selection</h1>
<p>Select your favourite video game genre to display posts from other gamers and create your own!</p>

<?php
require 'core/init.php';
$user = new User();

if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

$genre = DB::getInstance()->query("SELECT * FROM genre");

if(!$genre->count()){
	echo 'Cannot retrieve genres at this time';
} else {
	foreach($genre->results() as $genre) {
		echo "<p><a href =" .$genre->genre_name .".php>". $genre->genre_name ."</a></p>";
	}
}


?> 




