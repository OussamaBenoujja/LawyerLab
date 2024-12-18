<!-- component -->
<html>
    <head>
        <link rel="stylesheet" href="https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/css/main.ad49aa9b.css" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body >

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

        <div class="flex flex-row align-center items-center ">
            <div class="relative flex flex-col items-center rounded-[20px] w-[50%] mx-auto p-4 bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                <div class="relative flex h-32 w-full justify-center rounded-xl bg-cover" >
                    <img src='https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/media/banner.ef572d78f29b0fee0a09.png' class="absolute flex h-32 w-full justify-center rounded-xl bg-cover"> 
                    <div class="absolute -bottom-20 flex h-[130px] w-[130px] items-center justify-center rounded-full border-[4px] border-white bg-pink-400 dark:!border-navy-700">
                        <img class="h-full w-full rounded-full" src='../assets/img/pfp/law.png' alt="" />
                    </div>
                </div> 
                <div class="mt-16 flex flex-col items-center">
                    <h4 class="text-xl font-bold text-navy-700 dark:text-white">
                    Adela Parkson
                    </h4>
                    <p class="text-base font-normal text-gray-600">Lawyer</p>
                </div> 
                <div class="mt-6 mb-3 flex gap-14 md:!gap-14">
                    <div class="flex flex-col items-center justify-center">
                    <p class="text-2xl font-bold text-black ">34</p>
                    <p class="text-sm font-normal text-gray-600">Cases</p>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                    <p class="text-2xl font-bold text-black">
                        9
                    </p>
                    <p class="text-sm font-normal text-gray-600">Years of experience</p>
                    </div>
                </div>
                <p class="text-sm font-normal text-gray-600">Description</p>
                <div>
                <p class="text-sm font-normal text-gray-600 text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae consequatur soluta atque aliquid? A molestias, ducimus ab ipsa repellat distinctio qui debitis similique accusantium fuga beatae, incidunt eum quas quo.</p>
                </div>
            </div>  
            <div class="lg:w-7/12 md:w-9/12 sm:w-10/12 mx-auto p-4">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-3 bg-gray-700">
                        <button id="prevMonth" class="text-white">Previous</button>
                        <h2 id="currentMonth" class="text-white"></h2>
                        <button id="nextMonth" class="text-white">Next</button>
                    </div>
                    <div class="grid grid-cols-7 gap-2 p-4" id="calendar">
                        <!-- Calendar Days Go Here -->
                    </div>
                    <div id="myModal" class="modal hidden fixed inset-0 flex items-center justify-center z-50">
                    <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>
                    
                    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                        <div class="modal-content py-4 text-left px-6">
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">Selected Date</p>
                            <button id="closeModal" class="modal-close px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring">✕</button>
                        </div>
                        <div id="modalDate" class="text-xl font-semibold"></div>
                        </div>
                    </div>
                    </div>
                </div>
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
      // Function to generate the calendar for a specific month and year
function generateCalendar(year, month) {
    const calendarElement = document.getElementById('calendar');
    const currentMonthElement = document.getElementById('currentMonth');
    
    // Create a date object for the first day of the specified month
    const firstDayOfMonth = new Date(year, month, 1);
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    
    // Clear the calendar
    calendarElement.innerHTML = '';

    // Set the current month text
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    currentMonthElement.innerText = `${monthNames[month]} ${year}`;
    
    // Calculate the day of the week for the first day of the month (0 - Sunday, 1 - Monday, ..., 6 - Saturday)
    const firstDayOfWeek = firstDayOfMonth.getDay();

    // Create headers for the days of the week
    const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    daysOfWeek.forEach(day => {
        const dayElement = document.createElement('div');
        dayElement.className = 'text-center font-semibold';
        dayElement.innerText = day;
        calendarElement.appendChild(dayElement);
    });

    // Create empty boxes for days before the first day of the month
    for (let i = 0; i < firstDayOfWeek; i++) {
        const emptyDayElement = document.createElement('div');
        calendarElement.appendChild(emptyDayElement);
    }

    // Create boxes for each day of the month
    for (let day = 1; day <= daysInMonth; day++) {
        const dayElement = document.createElement('div');
        dayElement.className = 'text-center py-2 border cursor-pointer';
        dayElement.innerText = day;

        // Check if this date is the current date
        const currentDate = new Date();
        if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate.getDate()) {
            dayElement.classList.add('bg-blue-500', 'text-white'); // Add classes for the indicator
        }

        calendarElement.appendChild(dayElement);
    }
}

// Initialize the calendar with the current month and year
const currentDate = new Date();
let currentYear = currentDate.getFullYear();
let currentMonth = currentDate.getMonth();
generateCalendar(currentYear, currentMonth);

// Event listeners for previous and next month buttons
document.getElementById('prevMonth').addEventListener('click', () => {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    generateCalendar(currentYear, currentMonth);
});

document.getElementById('nextMonth').addEventListener('click', () => {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    generateCalendar(currentYear, currentMonth);
});

// Function to show the modal with the selected date
function showModal(selectedDate) {
    const modal = document.getElementById('myModal');
    const modalDateElement = document.getElementById('modalDate');
    modalDateElement.innerText = selectedDate;
    modal.classList.remove('hidden');
}

// Function to hide the modal
function hideModal() {
    const modal = document.getElementById('myModal');
    modal.classList.add('hidden');
}

// Event listener for date click events
const dayElements = document.querySelectorAll('.cursor-pointer');
dayElements.forEach(dayElement => {
    dayElement.addEventListener('click', () => {
        const day = parseInt(dayElement.innerText);
        const selectedDate = new Date(currentYear, currentMonth, day);
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const formattedDate = selectedDate.toLocaleDateString(undefined, options);
        showModal(formattedDate);
    });
});

// Event listener for closing the modal
document.getElementById('closeModal').addEventListener('click', () => {
    hideModal();
});

    </script>



</html>