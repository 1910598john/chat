<?php
session_start();

$servername = "sql108.epizy.com";
$username = "epiz_31214209";
$password = "8XgUo6PEhYV1N";
$database = 'epiz_31214209_mydb';

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
$_SESSION['myavatar'] = $_POST['avatar'];

$sql = "INSERT INTO Messages(avatar, message, messagefrom, sentby, sentto)
VALUES('$avatar', '$message', '$from', '$user', '$to')";

if ($conn->query($sql) === TRUE) {
    
}

$conn->close();
?>
