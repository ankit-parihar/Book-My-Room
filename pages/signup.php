<?php
include('../includes/db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $locality = $_POST['locality'];
    $password = $_POST['password'];

  
    $sql = "INSERT INTO users (username, email, locality, password) VALUES ('$username', '$email','$locality','$password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: login.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<!-- CodingMaker-->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIGNUP</title>
    <!--CSS Style-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
 </head>
  <body> 
    <link rel="stylesheet" href="signup.css" type="text/css">


    <div class="box" > 
        <div class="form" >
      <form action="signup.php" method="post">
        <h2>REGISTER</h2>
        <div class="inputbox">
          <input type="text" id="username" name="username" required>
          <span>Name Your Account</span>
          <i></i>
        </div>

        <div class="inputbox">
            <input type="email" id="email" name="email" required>
            <span>Enter Your Email Address </span>
            <i></i>
          </div>
          
          <div class="inputbox">
            <input type="text" id="localality" name="locality" required>
            <span>Locality</span>
            <i></i>
          </div>

          <div class="inputbox">
            <input type="password" id="password" name="password" required>
            <span>Create a Password</span>
            <i></i>
          </div>

      
          <div class="links">
          </div>
          <div class="links">
            <a href="login.html">already have an account? Log in</a>
          </div>
          <input type="submit" value="Signup" name="submit"  >
      </form>
    </div>
  </div>
  </body>
</html>

