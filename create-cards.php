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
    <?php if(isset($_SESSION['new-deck-name'])){
        echo "<h1> Let's add cards to <span style='color:rebeccapurple'>" . $_SESSION['new-deck-name'] . "</span></h1>";
    }
    else {
        echo "<h1>OH no! This deck has no name. Please go back a page and add one. </h1>";
    }?>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        Front of Card: <input type="text" name="front" class="form-control" autofocus required /> <br/>
        Back of Card: <input type="text" name="back" class="form-control" required /> <br/>
        <input type="submit" name = "card-done" value="Add Card" class="btn btn-light" />
    </form>

    <br>

    <!---- referenced https://getbootstrap.com/docs/4.4/components/card/ --->

    <?php
    if(isset($_SESSION['last-front-added']) && isset($_SESSION['last-back-added']))
    {
        echo "Previous Card Added...";
        echo "<div class='card text-white bg-info mb-3' style='max-width: 18rem;'>
                            <div class='card-header'>" . $_SESSION['last-front-added'] . "</div>
                            <div class='card-body'>" . $_SESSION['last-back-added'] . "</div>
                        </div>";
    }
    ?>

    <a href="create-confirmation.php">
        <button class="btn btn-light">Finalize my Deck!</button>
    </a>

</div>

<?php
    function insertCard()
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
        $deck_title = $_SESSION['new-deck-name'];
        //card_id (will increment automatically)
        $front = $_SESSION['last-front-added'];
        $back = $_SESSION['last-back-added'];
        $review = 0;

        $query = "INSERT INTO card (username, deck_title, front, back, review)
                    VALUES(:u, :dt, :f, :b, :r)";

        $statement = $db->prepare($query);

        $statement->bindValue(':u', $username);
        $statement->bindValue(':dt', $deck_title);
        $statement->bindValue(':f', $front);
        $statement->bindValue(':b', $back);
        $statement->bindValue(':r', $review);
        $statement->execute();
        $statement->closeCursor();

    }

    if(isset($_POST['card-done']))
    {
        if(!isset($_SESSION['new-deck-cards']))
        {
            $_SESSION['new-deck-cards'] = array(); //an array to hold the new cards
        }
        $_SESSION['new-deck-cards'][$_POST['front']] = $_POST['back'];
        $_SESSION['last-front-added'] = $_POST['front'];
        $_SESSION['last-back-added'] = $_POST['back'];
        insertCard();
        header('Location: create-cards.php');
    }
?>

</body>

</html>
