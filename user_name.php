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

$user = $_SESSION['myusername'];

$sql = "SELECT name, username FROM Names";
$res = $conn->query($sql);

if ($res->num_rows > 0) {
  while($row = $res->fetch_assoc()) {
    if ($row['username'] == $user) {
      echo $row['name'];
    }
  }
}

$conn->close();
?>
