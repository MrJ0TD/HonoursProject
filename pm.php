<?php
require 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

$data = $user->data();



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
<script src="jqueryajax.js"></script>
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
        </li>  
        <li><a href="pm.php">View messages</a></li>  
       
      </ul>
    </div>
    </div>
  </div>
   </nav>
  <div class="row">
  <div id="post" class="col-lg-10 ">  
    
    <h1>Private Messages for <?php echo escape($data->username);?></h1>
</div>
     </div>


   <div class="message-block">
    <div class=".col-sm-6">
<?php 
   
$message = DB::getInstance()->query("SELECT DISTINCT sender,reciever FROM message where reciever='".$data->username."' ");



if(!$message->count()){
  echo 'There are currently no messages here!';
} else {
  echo "<div id='comment'>";
  foreach($message->results() as $message) {
  if($message->sender == $data->username){
	
	  echo"<div class='sent'>";
      echo " <div class='well'>";	
  echo  "</br><p>Conversation with :<a href = 'viewmessage.php?user=". $message->sender ."'>Yourself</a>";
  //  echo"<p>Created by :<a href='profile.php?user=".$message->usera."'".$message->usera."";
		
 
 echo"</div>";  
	}else
	
       echo"<div class='sent'>";
      echo " <div class='well'>";	
  echo  "</br><p>Conversation with :<a href = 'viewmessage.php?user=". $message->sender ."'>" . $message->sender ."</a>";
  //  echo"<p>Created by :<a href='profile.php?user=".$message->usera."'".$message->usera."";
		
 
 echo"</div>";  
  
	
	
  } 

}

    ?>
    </div>
  </div>
  <div class="row" id="sent">
  <div class=".col-sm-6">
  <div class="well">
<?php 
   
$message = DB::getInstance()->query("SELECT DISTINCT sender,reciever FROM message where sender='".$data->username."' ");



if(!$message->count()){
  echo 'You have not sent a message to anyone yet';
} else {
  echo "<div id='comment'><p> You have sent a message to but have yet to recieve a reply from:";
  foreach($message->results() as $message) {
	$reply=DB::getInstance()->query("SELECT DISTINCT sender,reciever FROM message where sender='".$message->reciever."' AND reciever='".$data->username."' ");
	
	if(!$reply->count()){

       echo"<div class='sent'>";
     	
  echo  "</br><li><a href = 'viewmessage.php?user=". $message->reciever ."'>" . $message->reciever ."</a></li>";
  //  echo"<p>Created by :<a href='profile.php?user=".$message->usera."'".$message->usera."";
		
 
 echo"</div>";  
  
}
	
  }
  if($reply->count()){
 ?>
<style type="text/css">#sent{
display:none;
}</style>
<?php

  } 

}

    ?>
    </div>
  
  </div>
</div>
  <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
            <div class="navbar-text pull-left" id="author">
		<p class="text-muted">&copy; Joshua McGregor 2015</p>
            </div>
            
            </div>
        </div>
  
</body>
</html>