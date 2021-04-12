<?php require('connect-db.php'); ?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta name="author" content="Katherine Johnson">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1"><!-- got style sheet from example from class -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="style/flashy-css.css" rel="stylesheet" type="text/css"/>
  </head>

  <body>

  <?php include('header.html'); ?>

  <?php session_start(); ?>

  <div class="container">
    <h1>Let's make a new flashcard deck!</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      Deck name: <input type="text" name="new-deck-name" class="form-control" autofocus required /> <br/>
      <input type="submit" value="Start adding cards" class="btn btn-light" />
    </form>
  </div>

  <?php
  function insertDeck()
  {
      global $db;

      //might want to check that these are set...
      $username = $_SESSION['user'];
      $deck_title = $_SESSION['new-deck-name'];

      $query = "INSERT INTO deck (username, deck_title)
                    VALUES(:u, :dt)";

      $statement = $db->prepare($query);
      $statement->bindValue(':u', $username);
      $statement->bindValue(':dt', $deck_title);
      $statement->execute();
      $statement->closeCursor();

  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && strlen($_POST['new-deck-name']) > 0)
  {
      $_SESSION['new-deck-name'] = $_POST['new-deck-name'];
      insertDeck();
      header('Location: create-cards.php');
  }
  ?>

</body>

</html>
