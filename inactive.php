<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = 'users';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user = $_SESSION['user'];

$sql = "UPDATE Names SET status = 'offline' WHERE name = '$user'";

if ($conn->query($sql) === TRUE ) {
  
}

$conn->close();
?>
