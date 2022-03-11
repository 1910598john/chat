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


$message = $_SESSION['message']; //message stored
$chosen = $_SESSION['chosen']; //chosen person username
$user = $_SESSION['myusername']; //user's username
$from = $_SESSION['from']; //sender name
$myavatar = $_SESSION['myavatar']; //my avatar
$both_convo2 = $chosen.$user;

$sql = "INSERT INTO ".$both_convo2."(avatar, message, messagefrom, sentby, sentto)
VALUES('$myavatar', '$message', '$from', '$user', '$chosen')";


if ($conn->query($sql) === TRUE ) {
    
}


$conn->close();
?>
