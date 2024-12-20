<?php
require("../db_config.php");

session_start();

if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = $_POST["password"];

    $sqlQ = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($con, $sqlQ);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // verficqtion
        if (password_verify($password, $user["password"])) {

            //session variables
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["first_name"] = $user["FirstName"];
            $_SESSION["last_name"] = $user["LastName"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];
            $_SESSION["pfp"] = $user["pfp"];
            $_SESSION["bday"] = $user["DateOFBirth"];

            //Logs
            $userId = $user["user_id"];
            $logSql = "INSERT INTO logs (user_ID, action_type, description) VALUES ('$userId', 'LOGIN', 'User logged in')";
            mysqli_query($con, $logSql);

            header("Location: home.php");
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/src/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>
<header>
    <div class="py-4 px-2 lg:mx-4 xl:mx-12">
        <nav class="flex items-center justify-between flex-wrap">
            <div class="w-full flex items-center justify-between">
                <div>
                    <a href="home.php" class="text-xl font-bold text-blue-500">LawyerLab</a>
                </div>
                <div class="space-x-4">
                    <a href="home.php" class="text-gray-800 hover:text-blue-500">Home</a>
                    <a href="login.php" class="text-gray-800 hover:text-blue-500">Login</a>
                    <a href="signup.php" class="text-gray-800 hover:text-blue-500">Sign Up</a>
                    <a href="profile.php" class="text-gray-800 hover:text-blue-500">Profile</a>
                </div>
            </div>
        </nav>
    </div>
</header>

<main class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login to Your Account</h2>
        
        <?php if(isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input type="email" name="email" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                <input type="password" name="password" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" 
                        class="mr-2 leading-tight">
                    <label class="text-sm" for="remember">
                        Remember me
                    </label>
                </div>
                <a href="#" class="text-sm text-blue-500 hover:text-blue-800">
                    Forgot password?
                </a>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" name="login"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Login
                </button>
                <a href="signup.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Create an account
                </a>
            </div>
        </form>
    </div>
</main>
</body>
</html>
