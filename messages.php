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
$user = $_SESSION['myusername'];
$to = $_POST['user']; //chosen person username
$from = $_SESSION['from']; //sender
$avatar = $_POST['avatar']; //
$status = $_SESSION['status'];
$_SESSION['myavatar'] = $_POST['avatar'];

$sql = "INSERT INTO Messages(avatar, message, messagefrom, sentby, sentto, status)
VALUES('$avatar', '$message', '$from', '$user', '$to', '$status')";

if ($conn->query($sql) === TRUE) {
    
}

$conn->close();
?>
