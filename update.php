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
				'name' => array(
						'required' => true,
						'min' =>2,
						'max' => 50
					),
				'about' => array(
						'required' => false,
						'min' =>2,
						'max' => 300
					)
			));
		if(isset($_POST['console'])){	
		if($validation->passed()) {
		
		$console = "";
		
			foreach ( $_POST['console'] as $con )
				{
				    $console .=   $con . ' ' ;
				}

			try{
				$user->update(array(
					'name' => Input::get('name'),
					'about'=> Input::get('about'),
					'console' => $console
					
					));

				Session::flash('home','Your details have been updated.');
				Redirect::to('index.php');
			} catch(Exception $e) {
				die($e->getMessage());
			}

		} else{
			foreach($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}

	} else {
	if($validation->passed()) {
		

			try{
				$user->update(array(
					'name' => Input::get('name'),
					'about'=> Input::get('about'),
					
					
					));

				Session::flash('home','Your details have been updated.');
				Redirect::to('index.php');
			} catch(Exception $e) {
				die($e->getMessage());
			}

		} else{
			foreach($validation->errors() as $error) {
				echo $error, '<br>';
			}
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
    
	<h2>Update Those Details!</h2>
</br>
    
  </div>
</div>


 <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">


<form action="" method="post">
	<div class="field">
		<label for="name">Name</label>
		<input type="text"class="textbox" name="name" value="<?php echo escape($user->data()->name); ?>">
		</br>
	</br>
		<label for="about">About you:</label>
		<textarea rows="4" cols="50" name="about" id="about"><?php echo escape($user->data()->about); ?>
		</textarea>
		
		</br>
		</br>
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
	</br>
 <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Update</button>
		<input type="hidden" name="token" value="<?php echo Token:: generate(); ?>">
	</div>

</form>

<form action="imageupload.php" method="post" enctype="multipart/form-data">
    Select an image to upload as your profile picture:
    <input type="file" name="fileToUpload" id="fileToUpload">
    </br>
     <button class="btn btn-sm btn-primary btn-block" type="submit">
                    Upload Image</button>
</form>
</div>
</div>
<div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
            <div class="navbar-text pull-left" id="author">
		<p class="text-muted">&copy; Joshua McGregor 2015</p>
            </div>
            
            </div>
        </div>