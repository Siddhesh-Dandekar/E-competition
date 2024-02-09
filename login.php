<?php
//This script will handle login
session_start();

// check if the user is already logged in
if (isset($_SESSION['email_address'])) {
  header("location: sub_folder/main.html");
  exit;
}
require_once "config.php";

$email_address = $password = $phone = $reward = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (empty(trim($_POST['email_address'])) || empty(trim($_POST['password']))) {
    $err = "Please enter email_address + password";
    echo '<script>alert("email_address and Password cannot be blank")</script>';
  } else {
    $email_address = trim($_POST['email_address']);
    $password = trim($_POST['password']);
  }


  if (empty($err)) {
    $sql = "SELECT user_id, email_address, password, phone, reward FROM users WHERE email_address = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_email_address);
    $param_email_address = $email_address;


    // Try to execute this statement
    if (mysqli_stmt_execute($stmt)) {
      mysqli_stmt_store_result($stmt);
      if (mysqli_stmt_num_rows($stmt) == 1) {
        mysqli_stmt_bind_result($stmt, $id, $email_address, $hashed_password, $phone, $reward);
        if (mysqli_stmt_fetch($stmt)) {
          if (password_verify($password, $hashed_password)) {
            // this means the password is corrct. Allow user to login
            session_start();
            $_SESSION["email_address"] = $email_address;
            $_SESSION["phone"] = $phone;
            $_SESSION["user_id"] = $id;
            $_SESSION["reward"] = $reward;
            $_SESSION["loggedin"] = true;

            //Redirect user to welcome page
            header("location: sub_folder/main.html");

          }
        }

      }

    }
  }


}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style/font.css">
  <title>Student Login</title>
</head>

<body>

  <header class="text-gray-400 bg-black body-font">
    <div class="container mx-auto flex flex-wrap p-3 flex-col md:flex-row items-center">
      <a class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
        <img class="w-15 h-16 text-white bg-indigo-500 rounded-full" src="img/loadout-logo.jpg" alt="">
        <span class="ml-3 text-3xl" style="font-family: 'Alkatra', cursive;">E-Sports Competition</span>
      </a>
      <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
        <a href="index.html" class="mr-5 hover:text-white text-2xl" style="font-family: 'Alkatra', cursive;">Home</a>
        <a href="admin/admin_login.php" class="mr-5 hover:text-white text-2xl" style="font-family: 'Alkatra', cursive;">Admin Login</a>
      </nav>
      <button
        class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-white rounded text-2xl mt-4 md:mt-0">Contact
        us

      </button>
    </div>
  </header>



  <section class="bg-gray-500">
    <!-- component -->
    <!-- This is an example component -->
    <div
      class='flex items-center justify-center min-h-screen from-purple-900 via-indigo-800 to-indigo-500 bg-gradient-to-br'>
      <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white border rounded-lg shadow-2xl'>
        <form method="post">
          <div class='max-w-md mx-auto space-y-3'>
            <h3 class="text-lg font-semibold">Login</h3>
            <div>
              <label class="block py-1">Your email</label>
              <input type="email" name="email_address" 
                class="border w-full py-2 px-2 rounded shadow hover:border-indigo-600 ring-1 ring-inset ring-gray-300 font-mono">
              <p class="text-sm mt-2 px-2 hidden text-gray-600">Text helper</p>
            </div>
            <div>
              <label class="block py-1">Password</label>
              <input type="password" name="password" 
                class="border w-full py-2 px-2 rounded shadow hover:border-indigo-600 ring-1 ring-inset ring-gray-300 font-mono">
            </div>
            <div class="flex gap-3 pt-3 items-center">
            <input id="login_button" class="border hover:border-indigo-600 px-4 py-2 rounded-lg shadow ring-1 ring-inset ring-gray-300" type="submit" value="Login" />
              <a href="register.php">Register</a>
            </div>
          </div>
        </form>
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