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
  if(Input::exists()){
  
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        
        'comment' => array(
            'required'=> true,
            'min' => 2,
            'max' => 500
          )
      ));

    if($validation->passed()){

            $user = new user();

      
      

      try {
      if($user->data()->username == $data->username){
      	Session::flash('home', 'Your are not able to message yourself!');
        Redirect::to('index.php');
      	
      } 

        $user->message(array(
          'sender' => $user->data()->username,
          'reciever' => $data->username,
          'message' => Input::get('comment')
            
          ));
Session::flash('home', 'Your message has been sent!');
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
  
  

  
  ?>


<html>
<head>
  <title>Gamerlocator</title>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/style.css">
<!--<script src="pm.js"></script>-->
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
  
  



   <h1>Send a message to <?php echo escape($data->username); ?></h1>
  <!-- comment form -->

  <div class="success">

  </div>
  <div id="input-form">
  <form id="form"  action="" method="post">

</br>
    <label>
      <span>Your message *</span>
    </br>
      <textarea name="comment" id="comment" required="true" cols="30" rows="10" placeholder="Type your comment here...." required></textarea>
    </label>
</br>
    <input type="submit" id="submit" value="Submit Comment">
  </form>
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