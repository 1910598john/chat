<?php
session_start();
$_SESSION['user'] = $_POST['name'];

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

$name = $_POST['name'];

$sql = "INSERT INTO Names(name, status)
VALUES('$name', 'online')";

if ($conn->query($sql) === TRUE ) {
  
}

$conn->close();
?>