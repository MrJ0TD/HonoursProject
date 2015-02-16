<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
require 'core/init.php';

$user = new User();
if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

$data = $user->data();



		$file = $_FILES['image']['tmp_name'];
		
		if (!isset($file))
			echo "Please select an image.";
		else
		{
		$image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
		$image_name = $_FILES['image']['name'];
		$image_size = getimagesize($_FILES['image']['tmp_name']);
		$id = $data->id;
		
		
		if($image_size==FALSE)
			echo "That's not an image.";
		else
		{
	 	if(!$insert= DB::getInstance()->update('users',$id, array(
	 			'img_name' => "$image_name",
	 			'img' => "$image",
	 			

	 		)))echo "Problem uploading image.";
	 	 else{
	 		Session::flash('home','Your details have been updated.');
				Redirect::to('index.php');
	 	}
	 
	 }
}

?>