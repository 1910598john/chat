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
$user = $_SESSION['user'];

$both_convo = $user.$chosen;
$both_convo2 = $chosen.$user;

$sql = "INSERT INTO ".$both_convo."(message, sentby)
VALUES('$message', '$user');";


if ($conn->query($sql) === TRUE ) {
    header('location: test2.php');
}
else {
    header('location: test2.php');
}

$conn->close();
?>
