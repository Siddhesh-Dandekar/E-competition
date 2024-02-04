<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['email_address']))
{
    header("location: main.php");
    exit;
}
require_once "../config.php";

$email_address = $password = $phone = $reward =  "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['email_address'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter email_address + password";
		echo '<script>alert("email_address and Password cannot be blank")</script>';
    }
    else{
        $email_address = trim($_POST['email_address']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT user_id, email_address, password, phone, reward FROM users WHERE email_address = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_email_address);
    $param_email_address = $email_address;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $email_address, $hashed_password , $phone, $reward);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["email_address"] = $email_address;
							$_SESSION["phone"] =$phone;
                            $_SESSION["user_id"] = $id;
							$_SESSION["reward"] = $reward;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: main.html");
                            
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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Animated Login From</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <link rel="stylesheet" href="login.css" />
</head>

<body>
  <header class="back2">
    <div class="nav-handler">
      <nav class="left-nav">
        <img src="img/loadout-logo.jpg" alt="">
        <span>Gaming / Coding Competition</span>

      </nav>
      <nav class="right-nav">
        <ul>
          <li><a href="#back">Home</a></li>
          <li><a href="#main3">Admin Login</a></li>
          <li><a href="https://api.whatsapp.com/send/?phone=918826803334&text&type=phone_number&app_absent=0"
              target="_blank" rel="noopener" rel="noreferrer">Contact Us</a></li>
        </ul>

      </nav>
    </div>
  </header>
  <section class="section-1">
    <div class="login_form_container">



      <div class="login_form">
        <h2>Login</h2>

        <form method="post">
        <div class="input_group">
          <i class="fa fa-user"></i>
          
            <input type="text" name="email_address" placeholder="Username" class="input_text" autocomplete="off" />
        </div>
        <div class="input_group">
          <i class="fa fa-unlock-alt"></i>
          <input type="password" name="password" placeholder="Password" class="input_text" autocomplete="off" />
        </div>

        <input id="login_button" class="button_group" type="submit" value="Login" />
  
        </form>
      </div>
      
      <div class="fotter">
        <a>Forgot Password ?</a>
        <a>SingUp</a>
      </div>
    </div>
    
    </div>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="login.js"></script>
</body>

</html>