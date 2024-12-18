<?php
require("../db_config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $dateOfBirth = mysqli_real_escape_string($con, $_POST['dateOfBirth']);

    
    
    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $checkEmail);
    
    if (mysqli_num_rows($result) > 0) {
        $error = "Email already exists";
    } else {
        //add user
        $sql = "INSERT INTO users (FirstName, LastName, email, password, phone_number, role, DateOFBirth, Date_joined) 
                VALUES ('$firstName', '$lastName', '$email', '$password', '$phone', '$role', '$dateOfBirth', CURRENT_DATE)";
        //dont forget to redirect user with proper session info
        if (mysqli_query($con, $sql)) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . mysqli_error($con);
        }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sign Up</title>
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
        <h2 class="text-2xl font-bold mb-6 text-center">Create an Account</h2>
        
        <?php if(isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="firstName">First Name</label>
                    <input type="text" name="firstName" required 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastName">Last Name</label>
                    <input type="text" name="lastName" required 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input type="email" name="email" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone Number</label>
                <input type="tel" name="phone" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="dateOfBirth">Date of Birth</label>
                <input type="date" name="dateOfBirth" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="role">Account Type</label>
                <select name="role" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="client">Client</option>
                    <option value="lawyer">Lawyer</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                <input type="password" name="password" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Sign Up
                </button>
                <a href="login.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Already have an account?
                </a>
            </div>
        </form>
    </div>
</main>
</body>
</html>