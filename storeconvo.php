<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = 'convos';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$message = $_POST['message'];
$_SESSION['message'] = $_POST['message'];
$chosen = $_POST['user'];
$_SESSION['chosen'] = $_POST['user'];
$user = $_SESSION['username'];
$from = $_POST['messagefrom'];
$_SESSION['from'] = $from;

$both_convo = $user.$chosen;
$both_convo2 = $chosen.$user;

$sql = "INSERT INTO ".$both_convo."(message, messagefrom, sentby, sentto)
VALUES('$message','$from', '$user', '$chosen')";


if ($conn->query($sql) === TRUE ) {
  header('location: store.php');
}
else {
  header('location: store.php');
}



$conn->close();
?>
