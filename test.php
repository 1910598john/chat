<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "convos";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$chosen = $_SESSION['chosen'];
$user = $_SESSION['username'];

$both_convo2 = $chosen.$user;

$sql = "CREATE TABLE ".$both_convo2." (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  message VARCHAR(255) NOT NULL,
  sentby VARCHAR(30) NOT NULL)";



if ($conn->query($sql) === TRUE ) {
    header('location: chat.php');
}
else {
    header('location: chat.php');
}

$conn->close();
?>
