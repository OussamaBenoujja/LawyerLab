
<?php

session_start();

if(!isset($_SESSION["email"])){
    header("Location: login.php");
    exit;
}

require("../db_config.php");  // Make sure this points to your database connection file

// Function to check if lawyer has completed their profile
function checkLawyerProfile($userId, $connection) {
    $stmt = $connection->prepare("SELECT * FROM lawyerSub WHERE lw_ID = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->num_rows > 0;
}

// Check if user is a lawyer and hasn't completed their profile
$showProfileModal = false;
if(isset($_SESSION["role"]) && $_SESSION["role"] == 'lawyer') {
    if(!checkLawyerProfile($_SESSION["user_id"], $con)) {
        $showProfileModal = true;
    }
}

// Handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["complete_profile"])) {
    $speciality = $_POST["speciality"];
    $price = $_POST["price"];
    $userId = $_SESSION["user_id"];
    
    $stmt = $con->prepare("INSERT INTO lawyerSub (speciality, lw_ID, res_price) VALUES (?, ?, ?)");
    $stmt->bind_param("sid", $speciality, $userId, $price);
    
    if($stmt->execute()) {
        // Log the action
        $logStmt = $con->prepare("INSERT INTO logs (user_ID, action_type, description) VALUES (?, 'OTHER', 'Lawyer profile completed')");
        $logStmt->bind_param("i", $userId);
        $logStmt->execute();
        
        $showProfileModal = false;
        header("Location: home.php");
        exit;
    } else {
        $error = "Failed to save profile information. Please try again.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/css/main.ad49aa9b.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>

<?php if($showProfileModal): ?>
<div id="profileModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative p-8 bg-white w-full max-w-md mx-auto rounded-md shadow-lg mt-20">
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Complete Your Profile</h2>
            <p class="mb-4 text-gray-600">Please provide additional information to complete your lawyer profile</p>
        </div>
        
        <form method="POST" action="" class="space-y-4">
            <div>
                <label for="speciality" class="block text-sm font-medium text-gray-700">Speciality</label>
                <select name="speciality" id="speciality" required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Select your speciality</option>
                    <option value="Criminal Law">Criminal Law</option>
                    <option value="Family Law">Family Law</option>
                    <option value="Corporate Law">Corporate Law</option>
                    <option value="Civil Rights">Civil Rights</option>
                    <option value="Real Estate Law">Real Estate Law</option>
                    <option value="Tax Law">Tax Law</option>
                    <option value="Intellectual Property">Intellectual Property</option>
                </select>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Consultation Price (per hour)</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input type="number" name="price" id="price" required
                        class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="0.00" min="0" step="0.01">
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button type="submit" name="complete_profile"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Complete Profile
                </button>
            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('profileModal');
    
    // Prevent closing the modal by clicking outside since this is required information
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            e.preventDefault();
        }
    });

    // Form validation
    const form = modal.querySelector('form');
    form.addEventListener('submit', function(e) {
        const speciality = document.getElementById('speciality').value;
        const price = document.getElementById('price').value;
        
        if (!speciality || !price) {
            e.preventDefault();
            alert('Please fill in all required fields');
        }
        
        if (price < 0) {
            e.preventDefault();
            alert('Price cannot be negative');
        }
    });
});
</script>
<?php endif; ?>

<header>

        <div class="py-4 px-2 lg:mx-4 xl:mx-12 ">
            <div class="">
                <nav class="flex items-center justify-between flex-wrap  ">
                    <div class="block lg:hidden">
                        <button
                            class="navbar-burger flex items-center px-3 py-2 border rounded text-white border-white hover:text-white hover:border-white">
                            <svg class="fill-current h-6 w-6 text-gray-700" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Menu</title>
                                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                            </svg>
                        </button>
                    </div>
                    <div id="main-nav" class="w-full flex-grow lg:flex items-center lg:w-auto hidden  ">
                        <div class="text-sm lg:flex-grow mt-2 animated jackinthebox xl:mx-8">
                            <a href="#home"
                                class="block lg:inline-block text-md font-bold  text-blue-500  sm:hover:border-indigo-400  hover:text-orange-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                                HOME
                            </a>
                            <a href="#home"
                                class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-blue-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                                ROAD & STORY
                            </a>
                            <a href="#home"
                                class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-blue-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                                ACCOMMODATION
                            </a>
                            <a href="#home"
                                class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-blue-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                                TOURS
                            </a>
                            <a href="#home"
                                class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-blue-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                                CONTACT US
                            </a>
                            <a href="#home"
                                class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-blue-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                                COMING SOON
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
  
</header>




<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-12">
    <div class="text-center pb-12">
        <h3 class="text-base font-bold text-indigo-600">
            Hello, <?php echo $_SESSION['last_name'] ?>.
        </h3>
        <h2 class="text-base font-bold text-indigo-600">
            We have the best Lawyers for consultation
        </h2>
        <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl font-heading text-gray-900">
            Pick a Lawyer that <b>satisfies</b> your needs
        </h1>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div class="relative mx-4 mt-4 h-100 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
                <img src="../assets/img/pfp/law.png" alt="profile-picture" />
            </div>
            <div class="p-6 text-center">
                <h4 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                Natalie Paisley
                </h4>
                <p class="block bg-gradient-to-tr from-pink-600 to-pink-400 bg-clip-text font-sans text-base font-medium leading-relaxed text-transparent antialiased">
                CEO / Co-Founder
                </p>
            </div>
            <div class="flex justify-center gap-7 p-6 pt-2">
                <a
                href="#facebook"
                class="block bg-gradient-to-tr from-blue-600 to-blue-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                >
                <i class="fab fa-facebook" aria-hidden="true"></i>
                </a>
                <a
                href="#twitter"
                class="block bg-gradient-to-tr from-light-blue-600 to-light-blue-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                >
                <i class="fab fa-twitter" aria-hidden="true"></i>
                </a>
                <a
                href="#instagram"
                class="block bg-gradient-to-tr from-purple-600 to-purple-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                >
                <i class="fab fa-instagram" aria-hidden="true"></i>
                </a>
            </div>
            </div>

            <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div class="relative mx-4 mt-4 h-100 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
                <img src="../assets/img/pfp/law.png" alt="profile-picture" />
            </div>
            <div class="p-6 text-center">
                <h4 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                Natalie Paisley
                </h4>
                <p class="block bg-gradient-to-tr from-pink-600 to-pink-400 bg-clip-text font-sans text-base font-medium leading-relaxed text-transparent antialiased">
                CEO / Co-Founder
                </p>
            </div>
            <div class="flex justify-center gap-7 p-6 pt-2">
                <a
                href="#facebook"
                class="block bg-gradient-to-tr from-blue-600 to-blue-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                >
                <i class="fab fa-facebook" aria-hidden="true"></i>
                </a>
                <a
                href="#twitter"
                class="block bg-gradient-to-tr from-light-blue-600 to-light-blue-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                >
                <i class="fab fa-twitter" aria-hidden="true"></i>
                </a>
                <a
                href="#instagram"
                class="block bg-gradient-to-tr from-purple-600 to-purple-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                >
                <i class="fab fa-instagram" aria-hidden="true"></i>
                </a>
            </div>
            </div>

            <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div class="relative mx-4 mt-4 h-100 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
                <img src="../assets/img/pfp/law.png" alt="profile-picture" />
            </div>
            <div class="p-6 text-center">
                <h4 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                Natalie Paisley
                </h4>
                <p class="block bg-gradient-to-tr from-pink-600 to-pink-400 bg-clip-text font-sans text-base font-medium leading-relaxed text-transparent antialiased">
                CEO / Co-Founder
                </p>
            </div>
            <div class="flex justify-center gap-7 p-6 pt-2">
                <a
                href="#facebook"
                class="block bg-gradient-to-tr from-blue-600 to-blue-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                >
                <i class="fab fa-facebook" aria-hidden="true"></i>
                </a>
                <a
                href="#twitter"
                class="block bg-gradient-to-tr from-light-blue-600 to-light-blue-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                >
                <i class="fab fa-twitter" aria-hidden="true"></i>
                </a>
                <a
                href="#instagram"
                class="block bg-gradient-to-tr from-purple-600 to-purple-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                >
                <i class="fab fa-instagram" aria-hidden="true"></i>
                </a>
            </div>
            </div>

            <div class="relative flex w-96 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div class="relative mx-4 mt-4 h-100 overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
                <img src="../assets/img/pfp/law.png" alt="profile-picture" />
            </div>
            <div class="p-6 text-center">
                <h4 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                Natalie Paisley
                </h4>
                <p class="block bg-gradient-to-tr from-pink-600 to-pink-400 bg-clip-text font-sans text-base font-medium leading-relaxed text-transparent antialiased">
                CEO / Co-Founder
                </p>
            </div>
            <div class="flex justify-center gap-7 p-6 pt-2">
                <a
                href="#facebook"
                class="block bg-gradient-to-tr from-blue-600 to-blue-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                >
                <i class="fab fa-facebook" aria-hidden="true"></i>
                </a>
                <a
                href="#twitter"
                class="block bg-gradient-to-tr from-light-blue-600 to-light-blue-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                >
                <i class="fab fa-twitter" aria-hidden="true"></i>
                </a>
                <a
                href="#instagram"
                class="block bg-gradient-to-tr from-purple-600 to-purple-400 bg-clip-text font-sans text-xl font-normal leading-relaxed text-transparent antialiased"
                >
                <i class="fab fa-instagram" aria-hidden="true"></i>
                </a>
            </div>
            </div>


        
        
    </div>
</section>
</body>


<footer class="bg-blue-100/80 font-sans dark:bg-gray-900">
    <div class="container px-6 py-12 mx-auto">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-y-10 lg:grid-cols-4">
            <div class="sm:col-span-2">
                <h1 class="max-w-lg text-xl font-semibold tracking-tight text-gray-800 xl:text-2xl dark:text-white">Subscribe our newsletter to get an update.</h1>

                <div class="flex flex-col mx-auto mt-6 space-y-3 md:space-y-0 md:flex-row">
                    <input id="email" type="text" class="px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-blue-300" placeholder="Email Address" />
            
                    <button class="w-full px-6 py-2.5 text-sm font-medium tracking-wider text-white transition-colors duration-300 transform md:w-auto md:mx-4 focus:outline-none bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring focus:ring-gray-300 focus:ring-opacity-80">
                        Subscribe
                    </button>
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-800 dark:text-white">Quick Link</p>

                <div class="flex flex-col items-start mt-5 space-y-2">
                    <p class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Home</p>
                    <p class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Who We Are</p>
                    <p class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Our Philosophy</p>
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-800 dark:text-white">Industries</p>

                <div class="flex flex-col items-start mt-5 space-y-2">
                    <p class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Retail & E-Commerce</p>
                    <p class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Information Technology</p>
                    <p class="text-gray-600 transition-colors duration-300 dark:text-gray-300 dark:hover:text-blue-400 hover:underline hover:cursor-pointer hover:text-blue-500">Finance & Insurance</p>
                </div>
            </div>
        </div>
        
        <hr class="my-6 border-gray-200 md:my-8 dark:border-gray-700 h-2" />
        
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="flex flex-1 gap-4 hover:cursor-pointer">
                <img src="https://www.svgrepo.com/show/303139/google-play-badge-logo.svg" width="130" height="110" alt="" />
                <img src="https://www.svgrepo.com/show/303128/download-on-the-app-store-apple-logo.svg" width="130" height="110" alt="" />
            </div>
            
            <div class="flex gap-4 hover:cursor-pointer">
                <img src="https://www.svgrepo.com/show/303114/facebook-3-logo.svg" width="30" height="30" alt="fb" />
                <img src="https://www.svgrepo.com/show/303115/twitter-3-logo.svg" width="30" height="30" alt="tw" />
                <img src="https://www.svgrepo.com/show/303145/instagram-2-1-logo.svg" width="30" height="30" alt="inst" />
                <img src="https://www.svgrepo.com/show/94698/github.svg" class="" width="30" height="30" alt="gt" />
                <img src="https://www.svgrepo.com/show/22037/path.svg" width="30" height="30" alt="pn" />
                <img src="https://www.svgrepo.com/show/28145/linkedin.svg" width="30" height="30" alt="in" />
                <img src="https://www.svgrepo.com/show/22048/dribbble.svg" class="" width="30" height="30" alt="db" />
            </div>
        </div>
        <p class="font-sans p-8 text-start md:text-center md:text-lg md:p-4">© 2023 You Company Inc. All rights reserved.</p>
    </div>
</footer>


<script>
// Navbar Toggle
document.addEventListener('DOMContentLoaded', function () {

    // Get all "navbar-burger" elements
    var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  
    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {
  
      // Add a click event on each of them
      $navbarBurgers.forEach(function ($el) {
        $el.addEventListener('click', function () {
  
          // Get the "main-nav" element
          var $target = document.getElementById('main-nav');
  
          // Toggle the class on "main-nav"
          $target.classList.toggle('hidden');
  
        });
      });
    }
  
  });
  </script>




</html>