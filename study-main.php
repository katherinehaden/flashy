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
<h1> What would you like to study <?php if (isset($_SESSION['user'])) echo $_SESSION['user'] ?>?</h1>
    <!---- referenced https://getbootstrap.com/docs/4.4/components/card/ --->
    <br>

    <?php
    function getMyDecks()
    {
        global $db;

        $username = $_SESSION['user'];

        $query = "SELECT deck.deck_title FROM deck WHERE deck.username = :u";
        $statement = $db->prepare($query);
        $statement->bindValue(':u', $username);
        $statement->execute();
        $_SESSION['my-decks'] = $statement->fetchAll();
        $statement->closeCursor();

    }

    if(isset($_SESSION['my-decks']))
    {
        unset($_SESSION['my-decks']);
    }
    getMyDecks();
    ?>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
    <?php
    foreach($_SESSION['my-decks'] as $i => $result)
    {
        echo "<div class='card text-white bg-info mb-3' style='max-width: 18rem;'>";
        echo "<button class='btn btn-light' name='study-this-deck' ";
        echo "value= '" . $result['deck_title'] . "' >";
        echo $result['deck_title'];
        echo "</button></div>";
    }
    ?>
    </form>

    <?php
        if(isset($_GET['study-this-deck']))
        {
            setcookie('study-deck', $_GET['study-this-deck'], time()+3600);
            Header('Location: study.php');
        }
    ?>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
      <input type="submit" name="btnaction" value="Delete Deck" class="btn btn-light" /> <select name="deck-name" id="deck_titles">
        <?php
            foreach($_SESSION['my-decks'] as $i => $result)
            {
                echo "<option  value=" . $result['deck_title'] . "' >";
                echo $result['deck_title'];
                echo "</option>";
            }
        ?>
    </select>
    </form>

    <?php
    if (isset($_GET['btnaction']))
    {
       try
       {
          switch ($_GET['btnaction'])
          {
             case 'Delete Deck': deleteData();  break;
             //Will add button to update and add decks later
          }
       }
       catch (Exception $e)       // handle any type of exception
       {
          $error_message = $e->getMessage();
          echo "<p>Error message: $error_message </p>";
       }
    }
    ?>
    <?php
    function deleteData()
    {
         global $db;
         $deck_title = htmlspecialchars($_GET['deck-name']);
         $deck_title = substr($deck_title, 0, -1); //Looked up this method online to remove ' from end of deck title
         $username = $_SESSION['user'];


         $query = "DELETE FROM deck WHERE deck_title = :deck_title and username = :username";
         $statement = $db->prepare($query);
         $statement->bindValue(':deck_title', $deck_title);
         $statement->bindValue(':username', $username);


          $statement->execute();

         $statement->closeCursor();
         header("Location: ".$_SERVER['PHP_SELF']);
    }
    ?>
</div>
</body>

</html>