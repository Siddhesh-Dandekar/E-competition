<?php

session_start();

if (!isset ($_SESSION['loggedadmin']) || $_SESSION['loggedadmin'] !== true) {
  header("location: admin_login.php");
}

require '../config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Escape user input for security
$heading = mysqli_real_escape_string($conn, $_POST["heading"]);
$author = mysqli_real_escape_string($conn, $_POST["author"]);
$blog_content = mysqli_real_escape_string($conn, $_POST["blog_content"]);

$imageData = file_get_contents($_FILES['blog_image']['tmp_name']);
$blogimage = base64_encode($imageData);


// SQL query to insert data
$sql = "INSERT INTO blogs (heading, author, blog_content, blog_image)
        VALUES ('$heading', '$author', '$blog_content', '$blogimage')";

if ($conn->query($sql) === TRUE) {
    echo "Blog post created successfully!";
    header("location: blog.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>