<?php
// PHP Script
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gaming";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO competitions (game_id, title, venue, price, image, start_date) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $game_id, $title, $venue, $price, $image, $start_date);

// Set parameters and execute
$game_id = $_POST['game_id'];
$title = $_POST['title'];
$venue = $_POST['venue'];
$price = $_POST['price'];

// Convert image to base64
$imageData = file_get_contents($_FILES['image']['tmp_name']);
$image = base64_encode($imageData);

$start_date = $_POST['start_date'];
$stmt->execute();

echo "New record created successfully";

$stmt->close();
$conn->close();
?>
