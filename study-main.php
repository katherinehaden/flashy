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
<h1> What would you like to study?</h1>
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

        //should probably be checking that all of these are set... ?
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