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

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT name, username, password, status FROM Names WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $_SESSION['user'] = $row['name'];
    $_SESSION['username'] = $row['username'];
    echo '<script>window.open("active.php", "_self");</script>';
  }
}
else {
  echo '<script>alert("Wrong credentials");</script>';
}

/*
while ($row = $result->fetch_assoc()){
    if ($row['password'] == $password && $row['username'] == $username) {
      $_SESSION['user'] = $row['name'];
      $_SESSION['username'] = $row['username'];
      echo '<script>window.open("active.php", "_self");</script>';
    }
    else {
      echo '<script>alert("wrong credentials");window.open("index.php", "_self");</script>';
    }
} */

?>