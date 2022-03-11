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

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT name, username, password, status FROM Names WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $_SESSION['myname'] = $row['name'];
    $_SESSION['myusername'] = $row['username'];
    $_SESSION['status'] = $row['status'];
  }
  echo '<script>window.open("active.php", "_self");</script>';
}
else {
  echo '<script>alert("Wrong credentials");</script>';
}


?>
