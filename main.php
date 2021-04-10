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
<body>
<?php include('header.html')?>

<head>
  <meta charset="utf-8">

  <title>Flashy</title>
  <meta name="description" content="flashy mainpage">
  <meta name="author" content="Elena Lensink">


</head>

<!-- Used from class form validation example -->
 <div class="container">
      <div id= "username-show" class="media-body"></div>
  </div>
<div class="container">
    <div id="login-page" class="login">
      <form id="myform" action="" onsubmit="return myfunction();return false">
        <label>Username: </label>
        <input type="text" id="username" class="form-control" autofocus required />
        <div id="user-msg" class="feedback"></div>  <br/>
          <label>Email: </label>
        <input type="text" id="eml" class="form-control" required />
          <div id="eml-msg" class="feedback"></div>  <br/>
        <label>Password: </label>
        <input type="password" id="pwd" class="form-control" required />
        <div id="pwd-msg" class="feedback"></div>  <br/>
        <input type="submit" onclick="signin();"class="btn btn-dark" value="Sign in" />
      </form>
    </div>
</div>


<script>

//<!-- used some in class ecamples like bind-event-with-param-->
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

   function myfunction(){
        var user = document.getElementById("username");
        document.getElementById("username-show").innerHTML = "<h1>Hi " + user.value + ", welcome to Flashy!</h1>";
        return false;

//<!-- I got this code from https://www.codexpedia.com/javascript/submitting-html-form-without-reload-the-page/#:~:text=Use%20jQuery's%20submit%20event%20to,prevent%20the%20page%20to%20reload. -->
//<!-- It is so that the form does not reload and so the username can still be used -->
   $(document).ready(function() {
    $(document).on('submit', '#my-form', function() {
      return false;
     });
    });
   }

</script>

</body>
</html>