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

        // WILL BE DELETED ONCE MAIN PAGE AND LOGIN IN ARE DONE!!
        if(!isset($_SESSION['username']))
        {
            $_SESSION['username'] = "test_user";
        }
        // !!!

        $username = $_SESSION['username'];

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

</div>
</body>

</html>