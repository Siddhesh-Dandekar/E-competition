<?php
require_once "config.php";

$email_address = $password = $confirm_password = $user_name = $phone = $branch = "";
$email_address_err = $password_err = $confirm_password_err = $user_name_err = $phone_err =  "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if email_address is empty
    if(empty(trim($_POST["email_address"]))){
        $email_address_err = "email_address cannot be blank";
    }
    else{
        $sql = "SELECT user_id FROM users WHERE email_address = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_email_address);

            // Set the value of param email_address
            $param_email_address = trim($_POST['email_address']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $email_address_err = "This email_address is already taken";
					echo '<script>alert("email_address is already taken")</script>'; 
                }
                else{
                    $email_address = trim($_POST['email_address']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

if(empty(trim($_POST['user_name']))){
	$user_name_err = "username cannot be blank";
}
else{
	$user_name = trim($_POST['user_name']);
}

// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
	
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
	echo '<script>alert("Password cannot be less than 5 characters")</script>';
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
    echo '<script>alert("Password Didnt match")</script>';
}

// Check for phone number field
if(empty(trim($_POST['phone']))){
    $phone_err = "phone cannot be blank";
}
else{
    $phone = trim($_POST['phone']);
}

// Check for Option Field
if(empty(trim($_POST['branch']))){
    $branch_err = "branch cannot be blank";
}
else{
    $branch = trim($_POST['branch']);
}


// If there were no errors, go ahead and insert into the database
if(empty($user_name_err) && empty($email_address_err) &&  empty($phone_err) &&  empty($branch_err) &&  empty($password_err) && empty($confirm_password_err) )
{
    $sql = "INSERT INTO users (user_name, email_address, phone, branch, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "sssss", $param_user_name, $param_email_address ,$param_phone, $param_branch , $param_password );

        // Set these parameters
		$param_user_name = $user_name;
        $param_email_address = $email_address;
		$param_phone    = $phone;
		$param_branch   = $branch;
		$param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
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
                <a class="mr-5 hover:text-white text-2xl" style="font-family: 'Alkatra', cursive;">Admin Login</a>
            </nav>
            <button
                class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-white rounded text-2xl mt-4 md:mt-0">Contact
                us

            </button>
        </div>
    </header>



    <section class="bg-gray-50 dark:bg-gray-900">
    <div class="bg-gray-200 w-full min-h-screen flex items-center justify-center">
            <div class="w-full py-8">
                <div class="bg-white w-5/6 md:w-3/4 lg:w-2/3 xl:w-[500px] 2xl:w-[550px] mt-8 mx-auto px-16 py-8 rounded-lg shadow-2xl">

                    <h2 class="text-center text-2xl font-bold tracking-wide text-gray-800">Sign Up</h2>
                    <p class="text-center text-sm text-gray-600 mt-2">Already have an account? <a href="login.php" class="text-blue-600 hover:text-blue-700 hover:underline" title="Sign In">Sign in here</a></p>

                    <form method="post" class="my-8 text-sm">
                        <div class="flex flex-col my-4">
                            <label for="name" class="text-gray-950">Full Name</label>
                            <input type="text" name="user_name" id="name" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900 font-mono" placeholder="Enter your name">
                        </div>

                        <div class="flex flex-col my-4">
                            <label for="email" class="text-gray-950">Email Address</label>
                            <input type="email" name="email_address" id="email" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your email">
                        </div>
                        
                        <div class="flex flex-col my-4">
                            <label for="phone" class="text-gray-950">Phone Number</label>
                            <input type="phone" name="phone" id="email" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your phone number">
                        </div>

                        <div class="flex flex-col my-4">
                            <label for="phone" class="text-gray-950">Branch</label>
                            <input type="phone" name="branch" id="email" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your Branch">
                        </div>

                        <div class="flex flex-col my-4">
                            <label for="password" class="text-gray-950">Password</label>
                            <div x-data="{ show: false }" class="relative flex items-center mt-2">
                                <input :type=" show ? 'text': 'password' " name="password" id="password" class="flex-1 p-2 pr-10 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your password" type="password">
                            </div>
                        </div>

                        <div class="flex flex-col my-4">
                            <label for="password_confirmation" class="text-gray-950">Password Confirmation</label>
                            <div x-data="{ show: false }" class="relative flex items-center mt-2">
                                <input :type=" show ? 'text': 'password' " name="confirm_password" id="password_confirmation" class="flex-1 p-2 pr-10 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your password again" type="password">
                            </div>
                        </div>
                    
                        <div class="my-4 flex items-center justify-start space-x-4">
                            <button class="bg-blue-600 hover:bg-blue-700 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl transition duration-150 uppercase">Sign Up</button>
                        </div>
                    </form>
                
                </div>
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
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-400">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-400">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-400">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
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