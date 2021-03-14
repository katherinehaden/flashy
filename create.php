<?php
$front = $back = NULL;
$front_msg = $back_msg = NULL;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if(!empty($_POST['front']))
     $front = $_POST['front'];
  else
     $front_msg = "<br> Please enter text for the front of your flashcard!";

  if(!empty($_POST['back']))
     $back = $_POST['back'];
  else
     $back_msg = "<br> Please enter text for the back of your flashcard!";

  if ($front != NULL && $back != NULL){
    $front = $back = NULL;
    $front_msg = $back_msg = NULL;
    //add card to database
  }
}
?>


<!DOCTYPE html>
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Decks</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="create.php">Create</a>
                <a class="dropdown-item" href="study.html">Study</a>
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

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<!--End of nav bar-->
   <h1 align="center">
     New Flashcard Deck
   </h1>


  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <table class="table table-borderless">
        <tr>
          <td width="45%" align="right"><label>Front: </label></td>
          <td>
            <input type="text" name="front" value="<?php if (!empty($_POST['front'])) echo $_POST['front'] ?>" autofocus />
              <span class='msg'> <?php if (empty($_POST['front'])) echo $front_msg ?> </span>
          </td>
        </tr>

        <tr>
          <td width="45%" align="right"><label>Back:</label></td>
          <td>
            <input type="text" name="back" value="<?php if (!empty($_POST['back'])) echo $_POST['back'] ?>"/>
              <span class='msg'><?php if (empty($_POST['back'])) echo $back_msg ?></span>
          </td>
        </tr>

        <tr>
          <td colspan=2 align="center">
          <input type="submit" value="Next Card" class="btn btn-secondary" />
          </td>
        </tr>

      </table>
  </form>

  <div class="created-cards" align="center">
    <p id="new-card"></p>
  </div>


 </body>

</html>