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

$message = $_POST['message'];
$user = $_SESSION['username'];
$to = $_POST['user'];
$from = $_SESSION['from'];


$sql = "INSERT INTO Messages(message, messagefrom, sentby, sentto)
VALUES('$message', '$from', '$user', '$to')";

if ($conn->query($sql) === TRUE) {
    
}

$conn->close();
?>
