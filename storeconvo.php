<?php
session_start();
$id = $_SESSION['id'];

$id += 1;

$_SESSION['id'] = $id;

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

$both_convo = $user.$chosen;
$both_convo2 = $chosen.$user;

$sql = "INSERT INTO ".$both_convo."(message, sentby, sentto)
VALUES('$message', '$user', '$chosen')";


if ($conn->query($sql) === TRUE ) {
  header('location: store.php');
}
else {
  header('location: store.php');
}



$conn->close();
?>
