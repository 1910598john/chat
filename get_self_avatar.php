<?php
session_start();

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

$user = $_SESSION['myusername'];

$sql = "SELECT avatar, username FROM names";
$res = $conn->query($sql);

if ($res->num_rows > 0) {
  while($row = $res->fetch_assoc()) {
    if ($row['username'] == $user) {
      echo $row['avatar'];
    }
  }
}

$conn->close();
?>
