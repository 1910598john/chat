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

$chosen = $_SESSION['chosen']; //chosen person username
$user = $_SESSION['myusername'];

$both_convo2 = $chosen.$user;

$sql = "CREATE TABLE ".$both_convo2." (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  avatar VARCHAR(255) NOT NULL,
  message VARCHAR(255) NOT NULL,
  messagefrom VARCHAR(50) NOT NULL,
  sentby VARCHAR(30) NOT NULL,
  sentto VARCHAR(30) NOT NULL)";



if ($conn->query($sql) === TRUE ) {
    
}


$conn->close();
?>
