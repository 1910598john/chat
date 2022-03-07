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

$user = $_POST['user']; //chosen user's username
$myusername = $_SESSION['myusername'];
//DELETE MESSAGE NOTIFICATION FROM CHOSEN USER
$sql = "DELETE FROM messages WHERE sentby = '$user' AND sentto = '$myusername'";

if ($conn->query($sql) === TRUE) {
    
}

$conn->close();
?>
