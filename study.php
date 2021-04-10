<?php require('connect-db.php'); ?>

<!DOCTYPE html>
 <head>
<meta name="author" content="Katherine Johnson">
  <link href="style/study-css.css" rel="stylesheet" type="text/css"/>
  <link href="style/flashy-css.css" rel="stylesheet" type="text/css"/>
 </head>

<?php session_start(); ?>

<?php
if(isset($_COOKIE['study-deck']))
{
    global $db;

    // WILL BE DELETED ONCE MAIN PAGE AND LOGIN IN ARE DONE!!
    if(!isset($_SESSION['username']))
    {
        $_SESSION['username'] = "test_user";
    }
    // !!!

    //should probably be checking that all of these are set... ?
    $username = $_SESSION['username'];
    $deck_title = $_COOKIE['study-deck'];

    $query = "SELECT front, back, review FROM card 
                WHERE username = :u AND deck_title = :dt";

    $statement = $db->prepare($query);
    $statement->bindValue(':u', $username);
    $statement->bindValue(':dt', $deck_title);
    $statement->execute();
    $_SESSION['current-study-deck'] = $statement->fetchAll();
    $statement->closeCursor();

    $_SESSION['current-study-card'] = 0;
    $cardSide = 0;

    echo $_SESSION['current-study-deck'][$_SESSION['current-study-card']][0];
    echo $_SESSION['current-study-deck'][$_SESSION['current-study-card']][1];
    echo $_SESSION['current-study-deck'][$_SESSION['current-study-card']][2];
    $starColor = '#d9d8d7';

}
else{
    $deck_title = "OH no! Something went wrong :(";
    $_SESSION['current-study-deck'] = array(); //do something more here??
    $_SESSION['current-study-card'] = 0;
    $cardSide = 0;
    $starColor = '#d9d8d7';
}

?>

 <body>

 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!-- got style sheet from example from class -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css">
  </head>
<body>
<!-- Beginning of nav bar (will be replaced with php include for next assignment) -->
      <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="main.html">Flashy</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
          <ul class="navbar-nav w-100"><!-- looked up bootstrap width to rearrange navbar elements-->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Decks</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="create-deck.php">Create</a>
                <a class="dropdown-item" href="study-main.php">Study</a>
             </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Games</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="#">Matching Mania</a>
                <a class="dropdown-item" href="#">Jeopardy</a>
             </div>
            </li>


          </ul>
        </div>
      </nav>
<!-- got scripts from example navbar from class -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<!-- End of nav bar  -->

  <div id="deck-title"> <?php echo $deck_title; ?></div>
  <div id="card-area">
      <div id='current-card' class='card' onclick='flip();'> <?php echo $_SESSION['current-study-deck'][$_SESSION['current-study-card']][$cardSide]?> </i></div>
      <button id='review-star' class='star' onclick='mark_for_review();' style='color: <?php echo $starColor ?>'><i class='fas fa-star fa-1x'></i></button>
  </div>
  <div id="nav-buttons">
    <button id="previous-button" onclick="previous();"><i class="fas fa-arrow-circle-left fa-3x"></i></button>
    <button id="index-display"><?php echo $_SESSION['current-study-card']+1?> out of <?php echo count($_SESSION['current-study-deck']) ?></button>
    <button id="next-button" onclick="next();"><i class="fas fa-arrow-circle-right fa-3x"></i></button>
  </div>
 </body>


  <?php

    //called when the user clicks the card area
    function flip(){
        global $cardSide;
          if($cardSide == 0){
            $cardSide = 1;
            //study();
          }
          else {
            $cardSide = 0;
            //study();
          }
    }
  ?>



<script src="study-js.js"></script>

</html>
