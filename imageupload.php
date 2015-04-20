<?php
require 'core/init.php';
ob_start();
$user = new user;
$target_dir = "images/";
$ext = basename($_FILES["fileToUpload"]["name"]);
$ext = explode(".",$ext);
$target_file = $target_dir . $user->data()->id .'-'. $user->data()->username .".".$ext[1];


$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}


// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    
    
    
    
	try{
		$user->update(array(
			'filepath' => $target_file,
			
			
			));
	
		Session::flash('home','Your details have been updated.');
		Redirect::to('index.php');
	} catch(Exception $e) {
		die($e->getMessage());
	}
		
			
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>