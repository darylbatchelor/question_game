<?php

session_start();
 if (!isset($_SESSION['loggedin'])) {
   header('location:login.php');

 } 

include('pages/connect.php');
//creates a game once logged in


if ($_SESSION['gamecreated'] == false) {
//selects the game just created

$query = "INSERT INTO `game` (`Game_ID`, `Date`) VALUES (NULL, CURRENT_TIMESTAMP)";
$result = mysqli_query($con, $query);
$query = "SELECT MAX(Game_ID) as `maxid` FROM `game`";
$result = mysqli_query($con, $query);
//saves the current game id into a session variable
$row = mysqli_fetch_assoc($result);
$currentgame = $row['maxid'];
//had to put this in here otherwise it would not work because of ***this
$query = "INSERT INTO `answers` (`Answer_ID`, `Question_ID`, `Game_ID`) VALUES (NULL, '200', '$currentgame')";
$result = mysqli_query($con, $query);
$_SESSION['currentgame'] = $currentgame;
$_SESSION['gamecreated'] = true;
}



if ($_GET) {
$currentgame = $_SESSION['currentgame'];
//***this 
$query = "SELECT * FROM `answers` WHERE `Game_ID` = '$currentgame' ";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) == 0) {

              echo "<br><h1>Sorry no matches found</h1>";
             
            } else {

              $answered = array();

                while ($row = mysqli_fetch_assoc($result)) {
                  //puts all answered questions into an array called $answered
                  array_push($answered, $row['Question_ID']);

}
}

include('pages/connect.php');
//need to fix this - - it resets after every button press
//$sexual = 0;
$makesexual = "`Category` <> 'Sexual' AND";
$checked = "";
if (isset($_GET['sexual'])) {
  $sexual = $_GET['sexual'];


if ($sexual == 1) {
  $makesexual = "`Category` = 'Sexual' AND";
  $checked = "checked";
}


  }

//just add this: WHERE `Category` = 'Sexual' AND  after `questions` below to turn into sexual game
$query = "SELECT * FROM `questions` WHERE " . $makesexual ." `Question_ID` NOT IN (" . implode(',', array_map('intval', $answered)) . ")";

$result = mysqli_query($con, $query);
//this shows the number of questions left
    //$printrows = mysqli_num_rows($result) - 1;
    //echo "number remaining qs: " . $printrows;

if (mysqli_num_rows($result) > 1) {
              
             $remainingqs = array();
            //puts remaining questions and their question ID's into an array
            while ($row = mysqli_fetch_assoc($result))  {

              array_push($remainingqs, array($row['Question'], $row['Question_ID'])); 
             }

             //generates a random number between 0 and the amount of questions remaining

            $random = rand(1, (mysqli_num_rows($result)));
           
           $questionid = $remainingqs[$random][1];
           

             //echos out a random question out from the remaining questions
             $question = "<h2 class='question'>" . $remainingqs[$random][0] . "</h2>";

             $currentgame = $_SESSION['currentgame'];

             $query = "INSERT INTO `answers` (`Answer_ID`, `Question_ID`, `Game_ID`) VALUES (NULL, '$questionid ', '$currentgame');";
             $result = mysqli_query($con,$query);
             
              
            } else {

               $question ="<h2 class='question'>You have answered all the questions</h2>";
}
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
        <title>Couple Question Game</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--favicon-->
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
         <!--favicon-->
 

        <link rel="stylesheet" href="css/bootstrap.min.css">
      
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/bootstrap-toggle.min.css">
        <link rel="stylesheet" href="css/main.css">

        <!--[if lt IE 9]>
            <script src="js/vendor/html5-3.6-respond-1.4.2.min.js"></script>
        <![endif]-->
    </head>
    <body class="Site">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    

<a class="myButton topButton" href="logout.php">End Game</a></li>


        <main class="Site-content">
    <!-- Main jumbotron for a primary marketing message or call to action 
    <div class="jumbotron color-scheme">
      <div class="container">
        <h1>Question game</h1>-->
        
      </div>
    </div>

    <div class="container">
      <!-- Main content area -->
      <div class="row">
        <div class="col-xs-12  main">

          <br>
          <!--<a href="index.php?spin=true" class="myButton">Question</a>-->
          <form role="form" method="get">
        
    
                <div class="form-group">
                  <label class="sexual-label" for="sexual">Make sexual?</label><br>
                  <input type="hidden" name="sexual" value="0" />
                  <input type="checkbox" id="sexual" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="danger" data-offstyle="default" value="1" name="sexual" <?php if (isset($checked)) {echo $checked;}?>
                </div>
                <br><br><br>

          <?php 
            if (isset($question)) {
              echo $question;
            }

          ?>
                <br><br><br>
                <button type="submit" class="myButton">Question</button>
            
          </form>
          
        </div>
        
     </main>

      <footer>
        <div class="container"><p>&copy; Batchelor 2016</p></div>

        
      </footer>
    </div> <!-- /container -->        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.js"></script>
        <script src="js/bootstrap-toggle.min.js"></script>
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
