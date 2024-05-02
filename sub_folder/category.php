<?php
//This script will handle login
session_start();

require_once "../config.php";

// check if the user is already logged in
if (!isset ($_SESSION['loggeduser']) || $_SESSION['loggeduser'] !== true) {
  header("location: ../login.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../style/font.css">
  <title>main page</title>
</head>

<body>

  <header class="text-gray-400 bg-black body-font">
    <div class="container mx-auto flex flex-wrap p-3 flex-col md:flex-row items-center">
      <a class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
        <img class="w-15 h-16 text-white bg-indigo-500 rounded-full" src="/img/loadout-logo.jpg" alt="">
        <span class="ml-3 text-3xl" style="font-family: 'Alkatra', cursive;">E-Sports Competition</span>
      </a>
      <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
        <a href="category.php" class="mr-5 hover:text-white text-2xl" style="font-family: 'Alkatra', cursive;">Home</a>
        <a href="profile.php" class="mr-5 hover:text-white text-2xl" style="font-family: 'Alkatra', cursive;">My Profile</a>
        <a href="../logout.php" class="mr-5 hover:text-white text-2xl" style="font-family: 'Alkatra', cursive;">Logout</a>
      </nav>
      <button
        class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-white rounded text-2xl mt-4 md:mt-0">Contact
        us

      </button>
    </div>
  </header>

  <section class="text-gray-600 body-font">

    <div class="bg-gray-100">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-32">
          <h2 class="text-2xl font-bold text-gray-900">Explore...</h2>

          <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0">
            <div class="group relative">
              <div
                class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                <img
                  src="https://images.unsplash.com/photo-1549451371-64aa98a6f660?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                  alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug."
                  class="h-full w-full object-cover object-center">
              </div>
              <h3 class="mt-6 text-sm text-gray-500">
                <a href="blog.php">
                  <span class="absolute inset-0"></span>
                  Get Latest Updates of your college organize events and Upcoming events.
                </a>
              </h3>
              <p class="text-base font-semibold text-gray-900">Latest Blog</p>
            </div>
            <div class="group relative">
              <div
                class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                <img
                  src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                  alt="Wood table with porcelain mug, leather journal, brass pen, leather key ring, and a houseplant."
                  class="h-full w-full object-cover object-center">
              </div>
              <h3 class="mt-6 text-sm text-gray-500">
                <a href="competition.php">
                  <span class="absolute inset-0"></span>
                  E-sports Competition or E-coding competitions Organize updates.
                </a>
              </h3>
              <p class="text-base font-semibold text-gray-900">E-Competition</p>
            </div>
            <div class="group relative">
              <div
                class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                <img
                  src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                  alt="Collection of four insulated travel bottles on wooden shelf."
                  class="h-full w-full object-cover object-center">
              </div>
              <h3 class="mt-6 text-sm text-gray-500">
                <a href="chatroom.php">
                  <span class="absolute inset-0"></span>
                  Real time Chat within Community with wide variety of Students Enrolled.
                </a>
              </h3>
              <p class="text-base font-semibold text-gray-900">Live Chat</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>


  <footer class="text-gray-400 bg-black body-font ">
    <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
      <a class="flex title-font font-medium items-center md:justify-start justify-center text-white">
        <img src="/img/loadout-logo.jpg" alt="" class="w-15 h-16 text-white bg-indigo-500 rounded-full">
        <span class="ml-3 text-2xl" style="font-family: 'Alkatra', cursive;">E-Sports Competition</span>
      </a>
      <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
        <a class="text-gray-400">
          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
            viewBox="0 0 24 24">
            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-400">
          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
            viewBox="0 0 24 24">
            <path
              d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
            </path>
          </svg>
        </a>
        <a class="ml-3 text-gray-400">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            class="w-5 h-5" viewBox="0 0 24 24">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
          </svg>
        </a>
        <a class="ml-3 text-gray-400">
          <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0"
            class="w-5 h-5" viewBox="0 0 24 24">
            <path stroke="none"
              d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
            </path>
            <circle cx="4" cy="4" r="2" stroke="none"></circle>
          </svg>
        </a>
      </span>
    </div>
  </footer>

</body>

</html>