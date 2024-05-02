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

$sql = "SELECT game_id, title, venue, price, image, start_date FROM competitions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Game ID: " . $row["game_id"]. "<br>";
        echo "Title: " . $row["title"]. "<br>";
        echo "Venue: " . $row["venue"]. "<br>";
        echo "Price: " . $row["price"]. "<br>";
        echo "Image: <br>";
        echo '<img src="data:image/jpeg;base64,'.$row['image'].'"/>';
        echo "<br>Start Date: " . $row["start_date"]. "<br><br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
