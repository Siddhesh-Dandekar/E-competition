<?php

session_start();

if (!isset ($_SESSION['loggedadmin']) || $_SESSION['loggedadmin'] !== true) {
    header("location: admin_login.php");
}

require '../config.php';

// Check connection
if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

// Escape user input for security (prevent SQL Injection)
$venue = mysqli_real_escape_string($conn, $_POST["venue"]);
$title = mysqli_real_escape_string($conn, $_POST["title"]);
$price = (float) $_POST["price"]; // Convert price to float
$game_id = mysqli_real_escape_String($conn, $_POST["game_id"]);
$start_date = $_POST["start_date"];

$imageData = file_get_contents($_FILES['image']['tmp_name']);
$image = base64_encode($imageData);

$sql = "INSERT INTO competitions (game_id, title, venue, price, image, start_date)
    VALUES (?, ?, ?, ?, ?, ?)"; // Use placeholders for clarity

$stmt = $conn->prepare($sql); // Prepare statement for security

// **Corrected Binding:**
$stmt->bind_param('ississ', $game_id, $title, $venue, $price, $image, $start_date);

if ($stmt->execute() === TRUE) {
    echo "Competition created successfully!";
    header("location: event.php"); // Or redirect as needed
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$stmt->close();
$conn->close();

?>