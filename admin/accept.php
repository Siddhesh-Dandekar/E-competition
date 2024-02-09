<?php
session_start();

if (!isset($_SESSION['loggedadmin']) || $_SESSION['loggedadmin'] !== true) {
    header("location: admin_login.php");
}

require '../config.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>accept</title>
</head>

<body>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['accept'])) {

        $email = trim($_POST['accept']);

        echo "<script>console.log('Debug Objects: " . $email . "' );</script>";

        $query = "UPDATE `users` SET `account_status`='Verifed' WHERE email_address='$email'";
        $success = $conn->query($query);
        if (!$success) {
            $msg = "Failed to change order status";
            echo '<script>
                    $(document).ready(function() {
                        $("#dialogMsg").text("' . $msg . '");
                        $("#signupDialog").modal();
                    });
                </script>';
        }
        if ($success) {
            echo "<script>
                alert('Account Rejected');
                window.location.href='dashboard.php';
                </script>";
        }
        $conn->close();
    }

    else if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['reject'])) {

        $email = trim($_POST['reject']);

        echo "<script>console.log('Debug Objects: " . $email . "' );</script>";

        $query = "UPDATE `users` SET `account_status`='Rejected' WHERE email_address='$email'";
        $success = $conn->query($query);
        if (!$success) {
            $msg = "Failed to change order status";
            echo '<script>
                $(document).ready(function() {
                    $("#dialogMsg").text("' . $msg . '");
                    $("#signupDialog").modal();
                });
            </script>';
        }
        if ($success) {
            echo "<script>
            alert('Account Rejected');
            window.location.href='dashboard.php';
            </script>";
        }
        $conn->close();
    }
    ?>
</body>

</html>