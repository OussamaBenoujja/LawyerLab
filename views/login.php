


<?php

require("../db_config.php");


if(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sqlQ = "SELECT * FROM users where email='$email' && password='$password'";
    if(mysqli_query($con, $sqlQ)){
        echo "UserExists";
    }else{
        echo "Error Logging in";
    }

}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN</title>
</head>
<body>
    
<nav>

</nav>

<main>
    <form method="POST" action="login.php">
        <label for='email'>Email</label>
        <input type='email' name='email'>
        <label for='password'>Password</label>
        <input type='password' name='password'>  
        <button type="submit" name="login">Log In</button>
    </form>
</main>

<footer>
</footer>

</body>
</html>