<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}
$data = $user->data();
	
$id = addslashes($_REQUEST['id']);


 $image = $data->image;

header("Content-Transfer-Encoding: binary");

echo $image;


?>