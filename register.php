<?php
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

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$src = "images/blank_avatar.png";
$avatar = addslashes($src);
$sql = "INSERT INTO Names(avatar, name, username, password, status)
VALUES('$avatar','$name', '$username', '$password', 'offline')";

if ($conn->query($sql) === TRUE ) {
    echo '<script>alert("registered!")</script>';
}

$conn->close();
?>
