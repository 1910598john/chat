<?php
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
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "INSERT INTO Names(name, username, password, status)
VALUES('$name', '$username', '$password', 'offline')";

if ($conn->query($sql) === TRUE ) {
    echo '<script>alert("registered!")</script>';
}

$conn->close();
?>
