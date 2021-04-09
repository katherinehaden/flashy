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

<div class="container">
<h1> What would you like to study?</h1>
    <!---- referenced https://getbootstrap.com/docs/4.4/components/card/ --->
    <br>
    <!--- TO DO: for each deck in the database attached to this user... ---->
    <div class='card text-white bg-info mb-3' style='max-width: 18rem;'>
        <!-- set a session variable to be the name of the deck when clicked??
                so the study page knows what data to load... --->
        <a href="study.html" class="btn btn-light" style="background-color:cadetblue">Name of Deck</a>
    </div>
    <div class='card text-white bg-info mb-3' style='max-width: 18rem;'>
        <a href="study.html" class="btn btn-light" style="background-color:cadetblue">Name of Deck #2</a>
    </div>
    <div class='card text-white bg-info mb-3' style='max-width: 18rem;'>
        <a href="study.html" class="btn btn-light" style="background-color:cadetblue">Name of a third deck</a>
    </div>
</div>



</body>

</html>