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

$message = $_SESSION['message'];
$chosen = $_SESSION['chosen'];
$user = $_SESSION['username'];


$both_convo2 = $chosen.$user;

$sql = "INSERT INTO ".$both_convo2."(message, sentby, sentto)
VALUES('$message', '$user', '$chosen')";


if ($conn->query($sql) === TRUE ) {
    
}


$conn->close();
?>
