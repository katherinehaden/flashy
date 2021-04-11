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
  <!-- Beginning of nav bar (will be replaced with php include for next assignment)-->
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
<!--End of nav bar-->

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

      // WILL BE DELETED ONCE MAIN PAGE AND LOGIN IN ARE DONE!!
      if(!isset($_SESSION['username']))
      {
          $_SESSION['username'] = "test_user";
      }
      // !!!

      //might want to check that these are set...
      $username = $_SESSION['username'];
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
