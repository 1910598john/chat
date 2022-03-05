<?php
session_start();
$bool = true;
$_SESSION['bool'] = $bool;

$servername = "localhost";
$username = "root";
$password = "";
$database = "convos";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$chosen = $_POST['user'];
$_SESSION['chosen'] = $_POST['user'];
$user = $_SESSION['username'];

$both_convo = $user.$chosen;

$sql = "CREATE TABLE ".$both_convo." (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  message VARCHAR(255) NOT NULL,
  messagefrom VARCHAR(50) NOT NULL,
  sentby VARCHAR(30) NOT NULL,
  sentto VARCHAR(30) NOT NULL)";



if ($conn->query($sql) === TRUE ) {
  header("location: test.php");
}
else {
  header("location: test.php");
}

$conn->close();
?>
