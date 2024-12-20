

<?php 


session_start();


if(!isset($_SESSION["email"])){
    header("Location: login.php");
    exit;
}

require("../db_config.php");

if (isset($_POST['submit'])) {
    
    $targetDir = "../assets/img/pfp"; 
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); 
    }

    
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . "/" . $fileName;  // Correct file path
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($imageFileType, $allowedTypes)) {
        
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {

            $userId = $_SESSION['user_id'];  

            
            $updateQ = "UPDATE users SET pfp = ? WHERE user_id = ?";
            
            if ($stmt = mysqli_prepare($con, $updateQ)) {
                
                mysqli_stmt_bind_param($stmt, "si", $targetFilePath, $userId);

                
                if (mysqli_stmt_execute($stmt)) {
                    
                    $_SESSION['pfp']   = $targetFilePath;
                    $_SESSION['phone'] = $_POST['phone_number'];
                    $_SESSION['city']  = $_POST['city'];
                    
                    echo "Profile picture uploaded and updated successfully!";
                    echo "<br><a href='" . $targetFilePath . "'>View Image</a>";
                    header("Location: profile.php");
                } else {
                    echo "Failed to update profile picture in the database.";
                }

                
                mysqli_stmt_close($stmt);
            } else {
                echo "Failed to prepare the SQL statement.";
            }

        } else {
            echo "Failed to upload the file.";
        }
    } else {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
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
    <title>Profile</title>
</head>
<body>






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
                                PROFILE
                            </a>
                            <a href="#home"
                                class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-blue-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                                LOG IN
                            </a>
                            <a href="#home"
                                class="block lg:inline-block text-md font-bold  text-gray-900  sm:hover:border-indigo-400  hover:text-blue-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                                SIGN UP
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

<section class="w-full overflow-hidden dark:bg-gray-900">
    <div class="flex flex-col">
        <!-- Cover Image -->
        <img src="../assets/img/banner.jpg" alt="User Cover"
                class="w-full xl:h-[20rem] lg:h-[18rem] md:h-[16rem] sm:h-[14rem] xs:h-[11rem]" />

        <!-- Profile Image -->
        <div class="sm:w-[80%] xs:w-[90%] mx-auto flex">
            <img src="<?php if(isset($_SESSION['pfp'])){echo $_SESSION['pfp'];}else{echo "../assets/img/pfp/law.png";} ?>" alt="User Profile"
                    class="rounded-md lg:w-[12rem] lg:h-[12rem] md:w-[10rem] md:h-[10rem] sm:w-[8rem] sm:h-[8rem] xs:w-[7rem] xs:h-[7rem] outline outline-2 outline-offset-2 outline-blue-500 relative lg:bottom-[5rem] sm:bottom-[4rem] xs:bottom-[3rem]" />

            <!-- FullName -->
            <h1
                class="w-full text-left my-4 sm:mx-4 xs:pl-4 text-gray-800 dark:text-white lg:text-4xl md:text-3xl sm:text-3xl xs:text-xl font-serif">
                <b><?php echo $_SESSION['last_name']." ".$_SESSION['first_name']; ?></b></h1>

            <button id="openModalBtn" class="bg-blue-500 text-white p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>

        </div>

        <div
            class="xl:w-[80%] lg:w-[90%] md:w-[90%] sm:w-[92%] xs:w-[90%] mx-auto flex flex-col gap-4 items-center relative lg:-top-8 md:-top-6 sm:-top-4 xs:-top-4">



            <!-- Detail -->
            <div class="w-full my-auto py-6 flex flex-col justify-center gap-2">
                <div class="w-full flex sm:flex-row xs:flex-col gap-2 justify-center">
                    <div class="w-full">
                        <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                            <div class="flex flex-col pb-3">
                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">First Name</dt>
                                <dd class="text-lg font-semibold"><?php echo $_SESSION['first_name']; ?></dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Last Name</dt>
                                <dd class="text-lg font-semibold"><?php echo $_SESSION['last_name']; ?></dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Date Of Birth</dt>
                                <dd class="text-lg font-semibold"><?php echo $_SESSION['bday']; ?></dd>
                            </div>
                        </dl>
                    </div>
                    <div class="w-full">
                        <dl class="text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                            <div class="flex flex-col pb-3">
                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Location</dt>
                                <dd class="text-lg font-semibold">Morocco, <?php if(isset($_SESSION['city'])){echo $_SESSION['city'];} ?></dd>
                            </div>

                            <div class="flex flex-col pt-3">
                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Phone Number</dt>
                                <dd class="text-lg font-semibold"><?php if(isset($_SESSION['phone'])){echo $_SESSION['phone'];} ?></dd>
                            </div>
                            <div class="flex flex-col pt-3">
                                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email</dt>
                                <dd class="text-lg font-semibold"><?php echo $_SESSION['email']; ?></dd>
                            </div>

                            <?php
                                if (isset($_SESSION['role']) && $_SESSION['role'] == 'lawyer') {
                                    $sp = $_SESSION['speciality'];
                                    $pr = $_SESSION['res_price'];  
                                    echo '
                                    <div class="flex flex-col pt-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Speciality</dt>
                                        <dd class="text-lg font-semibold">' . htmlspecialchars($sp) . '</dd>
                                    </div>
                                    <div class="flex flex-col pt-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Price Per Hour</dt>
                                        <dd class="text-lg font-semibold">' . htmlspecialchars($pr) . '</dd>
                                    </div>';
                                }
                            ?>
                        </dl>
                    </div>
                </div>
                
                <div class="my-10 lg:w-[70%] md:h-[14rem] xs:w-full xs:h-[10rem]">
                    <!--  -->
                    <h1
                        class="w-fit font-serif my-4 pb-1 pr-2 rounded-b-md border-b-4 border-blue-600 dark:border-b-4 dark:border-yellow-600 dark:text-white lg:text-4xl md:text-3xl xs:text-xl">
                        My Location</h1>

                    <!-- Location -->
                    <iframe
                width="100%"
                height="100%"
                frameborder="0"
                style="border:0"
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCkxgifZq4lzNa9eJdMsc39ckqw68A3-rM&q=<?= $_SESSION['city'] ?>"
                allowfullscreen>
            </iframe>
                </div>




            </div>

            <!-- Social Links -->
            <div
                class="fixed right-2 bottom-20 flex flex-col rounded-sm bg-gray-200 text-gray-500 dark:bg-gray-200/80 dark:text-gray-700 hover:text-gray-600 hover:dark:text-gray-400">
                <a href="https://www.linkedin.com/in/samuel-abera-6593a2209/">
                    <div class="p-2 hover:text-primary hover:dark:text-primary">
                        <svg class="lg:w-6 lg:h-6 xs:w-4 xs:h-4 text-blue-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12.51 8.796v1.697a3.738 3.738 0 0 1 3.288-1.684c3.455 0 4.202 2.16 4.202 4.97V19.5h-3.2v-5.072c0-1.21-.244-2.766-2.128-2.766-1.827 0-2.139 1.317-2.139 2.676V19.5h-3.19V8.796h3.168ZM7.2 6.106a1.61 1.61 0 0 1-.988 1.483 1.595 1.595 0 0 1-1.743-.348A1.607 1.607 0 0 1 5.6 4.5a1.601 1.601 0 0 1 1.6 1.606Z"
                                clip-rule="evenodd" />
                            <path d="M7.2 8.809H4V19.5h3.2V8.809Z" />
                        </svg>

                    </div>
                </a>
                <a href="https://twitter.com/Samuel7Abera7">
                    <div class="p-2 hover:text-primary hover:dark:text-primary">
                        <svg class="lg:w-6 lg:h-6 xs:w-4 xs:h-4 text-gray-900" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z" />
                        </svg>

                    </div>
                </a>
                <a href="">
                    <div class="p-2 hover:text-blue-500 hover:dark:text-blue-500">
                        <svg class="lg:w-6 lg:h-6 xs:w-4 xs:h-4 text-blue-700" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>
                <a href="https://www.youtube.com/@silentcoder7">
                    <div class="p-2 hover:text-primary hover:dark:text-primary">
                        <svg class="lg:w-6 lg:h-6 xs:w-4 xs:h-4 text-red-600" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Modal -->
<div id="updateProfileModal" class="modal fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="modal-content bg-white p-6 rounded-lg w-1/3">
        <button class="close-btn absolute top-0 right-0 p-2 text-gray-500 hover:text-black" aria-label="Close">&times;</button>
        <h2 class="text-xl font-semibold mb-4">Update Profile</h2>
        
        <form action="profile.php" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="image" class="block text-gray-700">Profile Picture:</label>
                <input type="file" name="image" id="image" accept="image/*" class="w-full p-2 border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="city" class="block text-gray-700">City:</label>
                <input type="text" name="city" id="city" value="<?php if(isset($_SESSION['city'])){echo $_SESSION['city'];} ?>" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" value="<?php if(isset($_SESSION['phone'])){echo $_SESSION['phone'];} ?>" required class="w-full p-2 border border-gray-300 rounded-md">
            </div>
            <button type="submit" name="submit" class="bg-blue-500 text-white p-2 rounded-md w-full">Update</button>
        </form>
    </div>
</div>



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

<script>
    const openModalBtn = document.getElementById("openModalBtn");
    const modal = document.getElementById("updateProfileModal");
    const closeModalBtn = document.querySelector(".close-btn");

    // Open the modal
    openModalBtn.onclick = function() {
        modal.classList.remove("hidden");
    }

    // Close the modal when clicking the close button
    closeModalBtn.onclick = function() {
        modal.classList.add("hidden");
    }

    // Close the modal when clicking outside the modal content
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    }
</script>

</html>