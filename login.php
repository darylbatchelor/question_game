<?php

if ($_POST) {
  //include('pages/connect.php');
	//$email = mysqli_real_escape_string($con, $_POST['email']);
	//$password = md5(mysqli_real_escape_string($con, $_POST['password']));
	//$query = "SELECT * FROM `user_questions` WHERE `email` = '$email' AND `password` = '$password'";
	//$result = mysqli_query($con, $query);
	//if (mysqli_num_rows($result) == 1) {
session_start();
  $_SESSION['loggedin'] = true;
  $_SESSION['gamecreated'] = false;
  header('location:index.php');
	//} else {
	//	$message = "<p class='error'>Incorrect email or password</p>";
	//}
}






?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Relationship Hacker</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link href='https://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/bootstrap.min.css">
      
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  
        <link rel="stylesheet" href="css/main.css">

        <!--[if lt IE 9]>
            <script src="js/vendor/html5-3.6-respond-1.4.2.min.js"></script>
        <![endif]-->
    </head>
    <body class="Site">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    

        


        <header class="jumbotron">
          <h1 class="title">Play the couples question game</h1>
        </header>

        <main class="Site-content">

        	<form role="form" method="post">
                <div class="form-group">
                  
                  <input type="hidden" class="focus" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  
                  <input type="hidden" class="focus" id="password" name="password" placeholder="Password">
                </div>
              <!-- loop ends here-->
     
                <button type="submit" class="myButton">Start a Game</button>
            
          </form>
        		
          <?php 
          	if (isset($message)) {
          		echo $message;
          	}
          ?>

     	</main>

      <footer>
        <div class="container"><p>&copy; Batchelor 2016</p></div>

        
      </footer>
    </div> <!-- /container -->        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.js"></script>
        <script src="js/main.js"></script>
       
        

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script> -->
    </body>
</html>
