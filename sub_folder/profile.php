<?php
//This script will handle login
session_start();

// check if the user is already logged in
if (!isset ($_SESSION['loggeduser']) || $_SESSION['loggeduser'] !== true) {
  header("location: ../login.php");
  exit;
}


require_once "../config.php";

// Get user ID from session (modify as needed)
$user_id = $_SESSION['user_id'];

// Fetch user details from the users table
$sql = "SELECT user_name, email_address, phone, branch, account_status FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    $user_name = $row["user_name"];
    $email_address = $row["email_address"];
    $phone = $row["phone"];
    $branch = $row["branch"];
    $account_status = $row["account_status"];
  }
} else {
  echo "No user found";
}

$stmt->close();
$conn->close();

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


  <section>
        <div class="bg-white w-full flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row text-[#161931]">

            <main class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
                <div class="p-2 md:p-4">
                    <div class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
                        <h2 class="pl-6 text-2xl font-bold sm:text-xl">Public Profile</h2>

                        <div class="grid max-w-2xl mx-auto mt-8">
                            <div class="flex flex-col items-center space-y-5 sm:flex-row sm:space-y-0">

                                <img class="object-cover w-32 h-32 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                                    src="https://cdnb.artstation.com/p/assets/images/images/063/047/111/large/-.jpg?1684575391"
                                    alt="Bordered avatar">
                            </div>

                            <div class="items-center mt-8 sm:mt-8 text-[#202142]">

                                <div
                                    class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                                    <div class="w-full">
                                        <label for="first_name"
                                            class="block mb-2 text-sm font-medium text-indigo-900">Full Name</label>
                                        <input type="text" id="first_name"
                                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                            placeholder="Your first name" value="<?php echo $user_name ?>" disabled readonly>
                                    </div>

                                    <div class="w-full">
                                        <label for="last_name"
                                            class="block mb-2 text-sm font-medium text-indigo-900 ">Phone Number</label>
                                        <input type="text" id="last_name"
                                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                            placeholder="Child Name" value="<?php echo $phone ?>" disabled readonly>
                                    </div>

                                </div>

                                <div class="mb-2 sm:mb-6">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-indigo-900 ">Your
                                        email</label>
                                    <input type="email" id="email"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        placeholder="your.email@mail.com" value="<?php echo $email_address ?>" disabled readonly>
                                </div>


                                <div class="mb-2 sm:mb-6">
                                    <label for="school"
                                        class="block mb-2 text-sm font-medium text-indigo-900 ">Account Status</label>
                                    <input type="text" id="phone"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        placeholder="phone" value="<?php echo $account_status ?>" disabled readonly>
                                </div>
                                <div class="mb-2 sm:mb-6">
                                    <label for="bus"
                                        class="block mb-2 text-sm font-medium text-indigo-900 ">Branch</label>
                                    <input type="text" id="bus"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        placeholder="bus number" value="<?php echo $branch ?>" disabled readonly>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </main>
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