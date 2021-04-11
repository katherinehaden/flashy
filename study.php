
 <?php require('connect-db.php'); ?>
 
 <!DOCTYPE html>
<html lang="en">
  <head>
      <meta name="author" content="Katherine Johnson">
      <link href="style/study-css.css" rel="stylesheet" type="text/css"/>
      <link href="style/flashy-css.css" rel="stylesheet" type="text/css"/>
  </head>

<?php include('header.html')?>

<?php session_start();

if(isset($_COOKIE['study-deck']))
    $study_deck_title = $_COOKIE['study-deck'];
else
    $study_deck_title = 'No deck chosen :(';
?>

<body onload="load_data_and_start();">
  <div id="deck-title"><?php echo $study_deck_title ?></div>
  <div id="card-area"></div>
  <div id="nav-buttons">
    <button id="previous-button" onclick="previous();"><i class="fas fa-arrow-circle-left fa-3x"></i></button>
    <button id="index-display"></button>
    <button id="next-button" onclick="next();"><i class="fas fa-arrow-circle-right fa-3x"></i></button>
  </div>
 </body>

<script src="study-js.js"></script>

</html>
