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
  <title>Student Login</title>
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
        <a href="registered.php" class="mr-5 hover:text-white text-2xl" style="font-family: 'Alkatra', cursive;">Registered event</a>
        <a href="../logout.php" class="mr-5 hover:text-white text-2xl"
          style="font-family: 'Alkatra', cursive;">Logout</a>
      </nav>
      <button
        class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-white rounded text-2xl mt-4 md:mt-0">Contact
        us

      </button>
    </div>
  </header>


  <section class="text-dark bg-white body-font">
    <div class="container px-5 py-10 mx-auto">
      <div class="flex flex-wrap w-full mb-5">
        <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
          <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-dark">Competition</h1>
          <div class="h-1 w-20 bg-indigo-500 rounded"></div>
        </div>
      </div>

      <div class="flex flex-wrap -m-4">
        <?php
        $sql = "SELECT competitions.competition_id, games.game_name, games.cordinator_name, competitions.title, competitions.venue, competitions.price, competitions.start_date, competitions.image
        FROM competitions
        INNER JOIN games ON competitions.game_id = games.game_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $competition_id = $row["competition_id"];
            $game_name = $row["game_name"];
            $cordinator_name =$row["cordinator_name"];
            $title = $row["title"];
            $venue = $row["venue"];
            $price = $row["price"];
            $start_date = $row["start_date"];
            $image = $row["image"]; // Get image data

            echo '
        <form action="php_enroll.php" method="post">
            <div class="xl:w-4/5 md:w-full p-4">
                <div class="bg-gray-800 bg-opacity-40 p-3 rounded-lg">
                    
                    <img class="h-40 rounded w-full object-cover object-center mb-2" src="data:image/jpeg;base64,'.$row['image'].'" alt="content">
                    <h2 class="text-lg text-dark font-medium title-font mb-2">' . $title . '</h2>
                    <h2 class="text-lg text-dark font-medium title-font mb-2">Prize Pool ₹' . $price . '</h2>
                    <h3 class="tracking-widest text-indigo-900 text-xs font-medium title-font">Date - ' . $start_date . '</h3>
                    <h3 class="tracking-widest text-indigo-900 text-xs font-medium title-font mb-2">Category - ' . $game_name . '</h3>
                    
                    <p class="leading-relaxed text-base">Venue - ' . $venue . '</p>
                    <p class="leading-relaxed text-base">Coordinator - ' . $cordinator_name . '</p>
                    <input type="hidden" name="competition_id" id="competition_id" value="' . $competition_id . '">
                    <input type="hidden" name="user_id" value="' .$_SESSION['user_id']. '">
                    <div class="flex justify-center mt-4">
                        <button type="submit" class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Register</button>
                    </div>
                </div>
            </div>
        </form>
        ';
          }
        }
        ?>

      </div>
    </div>
  </section>


  <footer class="text-gray-400 bg-black body-font">
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