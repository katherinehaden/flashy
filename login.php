<html lang="en">
<!doctype html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
    <meta name="viewport" content="width=device-width, initial-scale=2"> <!-- got style sheet from example from class -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="style/flashy-css.css" rel="stylesheet" type="text/css"/>
  </head>

<head>
  <meta charset="utf-8">

  <title>Flashy</title>
  <meta name="description" content="flashy mainpage">
  <meta name="author" content="Elena Lensink">


</head>
<body>

  <?php include('header.html') ?>
  <?php session_start(); ?>



<div class="container">
    <form id="myform"  method="post">

      <label>Username: </label>
        <input type="text" name="username" id="username" class="form-control" autofocus required />
        <div id="user-msg" class="feedback"></div>  <br/>
          <label>Email: </label>
        <input type="text" name="eml" id="eml" class="form-control" required />
          <div id="eml-msg" class="feedback"></div>  <br/>
        <label>Password: </label>
        <input type="password" name="pwd" id="pwd" class="form-control" required />
        <div id="pwd-msg" class="feedback"></div>  <br/>
      <input type="submit" value="Submit" class="btn btn-secondary" value="Sign in"
        />
    </form>


<?php
require('connect-db.php');

// require: if a required file is not found, require() produces a fatal error, the rest of the script won't run
// include: if a required file is not found, include() throws a warning, the rest of the script will run
?>

<?php


function authenticate()
{
   global $mainpage;
   global $db;


   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      // htmlspecialchars() stops script tags from being able to be executed and renders them as plaintext
      $pwd = htmlspecialchars($_POST['pwd']);
      $eml = htmlspecialchars($_POST['eml']);
      $username = htmlspecialchars($_POST['username']);


      $query = "SELECT `username`,`email`,`password` FROM `user` WHERE email = (:email)";

      $statement = $db->prepare($query);
      $statement->bindValue(':email', $eml);
      $statement->execute();
      $results = $statement->fetchAll();
      $statement->closeCursor();
      $numresults = 0;
      foreach($results as $result){
        $db_username = $result['username'];
        $db_email = $result['email'];
        $db_pwd = $result['password'];// Did not hash because this messed up cs webserver deployment
        $numresults = $numresults +1;
        }


      if($numresults > 0)
      {
        if($db_username != $username)
        {
            echo 'An account already exists with this email';
        }
        else if ($db_pwd == $pwd)
        {
            $_SESSION['user']= $username;
            header("Location: study-main.php");
        }
        else
        {
            echo 'Password Incorrect';
        }


      }
      else
      {
        $query2 = "SELECT `username`,`email`,`password` FROM `user` WHERE username = (:username)";

        $statement = $db->prepare($query2);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        $numresults = 0;
        foreach($results as $result)
        {
            $db_username = $result['username'];
            $numresults = $numresults +1;
        }

        if ($numresults>0)
        {
            echo 'That username is already chosen. Please select another username';
        }
        else
        {
            //$hash = password_hash($pwd, PASSWORD_BCRYPT); this messed up cs webserver deployment
            $query3 = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
            $statement = $db->prepare($query3);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':email', $eml);
            $statement->bindValue(':password', $pwd);
            $statement->execute();

            $statement->closeCursor();
            $_SESSION['user']= $username;
            header("Location: study-main.php");
        }
      }
   }
}
authenticate();
?>
<script>

//<!-- used some in class examples like bind-event-with-param-->
   var email = document.getElementById("eml");

   function checkEmail() {
      var msg1 = document.getElementById("eml-msg");
      var str_email = email.value;
      var includes = str_email.includes("@");
      if (includes)
         msg1.textContent = "";
      else
         msg1.textContent =  "Email must include @";
   }

   //<!-- Anonymous function used as parameter here -->
   email.addEventListener('blur', function() {
         checkEmail();
      }, false);


</script>
</div>
</div>


</body>
</html>