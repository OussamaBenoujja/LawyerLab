


<?php

require("../db_config.php");

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>LOG IN</title>
</head>
<body>
    
<nav>
        <span id="navLeft">
            Logo
        </span>

        <span id="navRight">

            <a>Home</a>
            <a>Log in</a>
            <a>Sign Up</a>
            <a>Calander</a>  
            <a>Profile</a>

        </span>

</nav>

<main id="loginbg">
    <form method="POST" action="login.php">
        <label for='email'>Email</label>
        <input type='email' name='email'>
        <label for='password'>Password</label>
        <input type='password' name='password'>  
        <button type="submit" name="signIn">Log In</button>
    </form>
</main>

<footer>
    
</footer>

</body>
</html>