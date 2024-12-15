<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MODtype</title>
        <link rel="stylesheet" href="styleregister.css">

        <!--box icons-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    </head>
    
    
<body>
  <!--login-->
  <section class="register" id="register">

    <div class="register-container">

      <h1>CREATE ACCOUNT</h1>

      <form action="process-register.php" method="post">
        <div>
          <label for="Username">Username:</label>
          <input name="username_account" type="text" id="username"  placeholder="username" required>
        </div>
        <div>
          <label for="Email">Email:</label>
          <input  name="email_account" id="email" type="email" placeholder="email" required>
        </div>
        <div>
          <label for="password">Password:</label>
          <input name="password_account1" type="password" id="password"  placeholder="password" required>  
        </div>
        <div>
          <label for="password">Confirm Password:</label>
          <input name="password_account2" type="password" id="password"  placeholder="confirm password"required>
        </div>
        <button type="submit">Confirm</button>
        <button type="button" onclick="window.location.href='login.php';">Login</button>
      </form>
    </div>

    
    <div class="home-imgHover"></div>
</section>
  <script src="Port3.js"></script>
</body>
    
</html>