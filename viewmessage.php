<?php
ob_start();
require 'core/init.php';

if(!$username = Input::get('user')) {
	Redirect::to('index.php');
} else {
	$user = new User($username);
	if(!$user->exists()) {
		Redirect::to(404);
	} else{
		
		$data = $user->data();
	}
	$user = new user();
	

?>


<html>
<head>
  <title>Gamerlocator</title>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GamerLocator</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/style.css">

</head>
<body>
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
         <li><a href="pm.php">View messages</a></li> 
       
      </ul>
    </div>
    </div>
  </div>
   </nav>
   
  <div class="row">
  <div id="post" class="col-lg-10 ">  
    
    <h1>Private Messages for <?php echo escape($user->data()->username);?></h1>
</div>
     </div>

<a href="#form">Go straight to the bottom</a>
   <div class="message-block">
    <div class=".col-sm-6">
<?php

$message = DB::getInstance()->query("SELECT * FROM message WHERE sender  = '".$user->data()->username."' and reciever = '".$data->username."' or sender='".$data->username."' and reciever = '".$user->data()->username."'");

if(!$message->count()){
  echo 'There are currently no messages here!';
} else {
  echo "<div id='comment'>";
  foreach($message->results() as $message) {

       echo " <div class='well'>";
     //echo"<p>Created by :<a href='profile.php?user=".$message->usera."'".$message->usera."";
     echo"<p>Created by:  <a href='profile.php?user=".$message->sender."'>".$message->sender."</a> and sent to <a href='profile.php?user=".$message->reciever."'>".$message->reciever."</a></p>";
     echo"<p>Message: ".$message->message."</p>";
     echo  "</br><p>Sent on: ". $message->added ."</p>";
 echo"</div>";   
  }
  
}
 if(Input::exists()){
  
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        
        'message' => array(
            'required'=> true,
            'min' => 2,
            'max' => 500
          )
      ));

    if($validation->passed()){
      $user = new user();

      
      

      try {

        $user->message(array(
          'sender' => $user->data()->username,
          'reciever' => $data->username,
          'message' => Input::get('message')
            
          ));
        Redirect::to('viewmessage.php?user='.$data->username.'#form');
        


      } catch(Exception $e){
        die($e->getMessage());
      }
    } else {
      foreach($validation->errors() as $error){
        echo $error, '<br>';
      }
    }
  } 
  
?>

  </div>
    </div>
    <a href="#top">Back to top</a>
    <div id="input-form">
  <form id="form"  action="" method="post">

</br>
    <label>
      <span>Add message to conversation:</span>
    </br>
      <textarea name="message" id="message" required="true" cols="30" rows="10" placeholder="Type your message here...." required></textarea>
    </label>
</br>
    <input type="submit" id="submit" value="Submit Comment" >
  </form>
  
  </div>
</div>
  </br>
  </br>
  </br>
  </br>
  <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
            <div class="navbar-text pull-left" id="author">
		<p class="text-muted">&copy; Joshua McGregor 2015</p>
            </div>
            
            </div>
        </div>
</body>
</html>
<?php
}