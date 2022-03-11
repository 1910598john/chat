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

$former_name = $_SESSION['myname'];
$new = $_POST['new_name'];

$sql = "UPDATE Names SET name = '$new' WHERE name = '$former_name'";

if ($conn->query($sql) === TRUE ) {
    $_SESSION['myname'] = $new;
}

$conn->close();
?>
