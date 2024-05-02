<?php

session_start();

require_once "../config.php";

// Check if the user is already logged in
if (!isset($_SESSION['loggeduser']) || $_SESSION['loggeduser'] !== true) {
  header("location: ../login.php");
  exit;
}

// Get user ID and competition ID from form/session/URL (modify as needed)
$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
$competition_id = isset($_POST['competition_id']) ? (int)$_POST['competition_id'] : 0;  // Replace with logic to retrieve competition ID

// Check for existing enrollment before insertion
$sql_check = "SELECT * FROM enrolled WHERE user_id = ? AND competition_id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ii", $user_id, $competition_id);
$stmt_check->execute();

$result = $stmt_check->get_result();

if ($result->num_rows === 0) {
  // User not enrolled, proceed with enrollment
  $sql = "INSERT INTO enrolled (user_id, competition_id) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $user_id, $competition_id);

  if ($stmt->execute()) {
    echo '<script>alert("SUCCESSFULLY ENROLLED")</script>';
    header("location: ./competition.php");
  } else {
    echo "Error: " . $stmt->error;
  }
} else {
  // User already enrolled, display message
  echo '<script>alert("USER ALREADY ENROLLED")</script>';
  
  header("location: ./competition.php");
}

$stmt_check->close();
// Close enrollment insert statement if executed
$conn->close();

?>