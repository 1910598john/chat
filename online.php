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

$user = $_SESSION['myname'];

$sql = "UPDATE Names SET status = 'online' WHERE name = '$user'";
$_SESSION['status'] = "online";
if ($conn->query($sql) === TRUE ) {
  
}

$conn->close();
?>
