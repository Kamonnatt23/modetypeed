<?php
session_start();
$open_connect = 1;
require('connect.php'); 

//$_SESSION['email_account'] = $email_account; 

//header('Location: process-play.php'); 
//exit();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MODtype</title>
        <link rel="stylesheet" href="stylelogin.css">

        <!--box icons-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    </head>
    
    
<body>
<img src="login4.png" alt="Description" class="small-image">
  <!--login-->
  <section class="login" id="login">
  
    <div class="login-container">
    <h1>LOGIN </h1>
    <form action="process-login.php" method="post">
        <div>
          <label for="email">Email:</label>
          <input  name="email_account" id="username" type="text" placeholder="Email" required>
        </div>
        <div>
          <label for="password">Password:</label>
          <input name="password_account" type="password" id="password" placeholder="password" required>
        </div>
  
        <button type="submit">Login</button>
        <button type="button" onclick="window.location.href='register.php';">Register</button>

      </form>
    </div>
</section>
</body>
    
</html>