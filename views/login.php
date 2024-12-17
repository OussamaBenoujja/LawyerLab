


<?php

require("../db_config.php");

session_start();

if (isset($_POST["login"])) {
    
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);

    
    $sqlQ = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $sqlQ);

    if (mysqli_num_rows($result) > 0) {
        echo "Login Successful!";
        while($row = $result->fetch_assoc()){
            $_SESSION["first_name"] = $row["FirstName"];
            $_SESSION["last_name"] = $row["LastName"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["auth"] = md5($row["email"] . $password);
            $_SESSION["pfp"] = $row["pfp"];
            $_SESSION["role"] = $row["role"];
        }
        

        header("Location: home.php");


    } else {
        echo "Invalid email or password!";
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