<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = 'convos';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$message = $_SESSION['message']; //message stored
$chosen = $_SESSION['chosen']; //chosen person username
$user = $_SESSION['myusername']; //user's username
$from = $_SESSION['from']; //sender name


$both_convo2 = $chosen.$user;

$sql = "INSERT INTO ".$both_convo2."(message, messagefrom, sentby, sentto)
VALUES('$message', '$from', '$user', '$chosen')";


if ($conn->query($sql) === TRUE ) {
    
}


$conn->close();
?>
