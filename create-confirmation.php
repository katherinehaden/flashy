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
    <h1> Your new deck has been added! </h1>
    <?php
        echo "<h2 style='text-align: center;'>";
        if (isset($_SESSION['new-deck-name'])) echo $_SESSION['new-deck-name'];
        echo "</h2>";

        //referenced https://getbootstrap.com/docs/4.4/components/card/

        echo "<div class='card-columns'>";
            if(isset($_SESSION['new-deck-cards']))
            {
                foreach ($_SESSION['new-deck-cards'] as $front => $back) {
                    echo "<div class='card text-white bg-info mb-3' style='max-width: 18rem;'>
                        <div class='card-header'>" . $front . "</div>
                        <div class='card-body'>" . $back . "</div>
                    </div>";
                }
            }
            ?>
        </div>

    <h2> Would you like to <a href="study-main.php">study</a> now?</h2>
</div>

<?php
//clearing the session elements...
if(isset($_SESSION['new-deck-name']))
{
    unset($_SESSION['new-deck-name']);
}
if(isset($_SESSION['new-deck-cards']))
{
    unset($_SESSION['new-deck-cards']);
}
if(isset($_SESSION['last-front-added']))
{
    unset($_SESSION['last-front-added']);
}
if(isset($_SESSION['last-back-added']))
{
    unset($_SESSION['last-back-added']);
}
?>


</body>

</html>