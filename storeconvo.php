<?php
session_start();

$servername = "192.168.1.6";
$username = "root";
$password = "root";
$database = 'test';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$message = addslashes($_POST['message']); //message
$_SESSION['message'] = addslashes($_POST['message']); //store in a cookie
$chosen = $_POST['user']; //chosen person username
$_SESSION['chosen'] = $_POST['user']; //store chosen person username
$user = $_SESSION['myusername']; //user's username
$from = $_POST['messagefrom']; //store message in a cookie
$_SESSION['from'] = $from; //store sender name..
$avatar = $_POST['avatar']; //my avatar
$_SESSION['myavatar'] = $_POST['avatar']; //store my avatar
$both_convo = $user.$chosen;
$both_convo2 = $chosen.$user;


$sql = "INSERT INTO ".$both_convo."(avatar, message, messagefrom, sentby, sentto)
VALUES('$avatar', '$message', '$from', '$user', '$chosen')";


if ($conn->query($sql) === TRUE ) {
  header('location: store.php');
}
else {
  header('location: store.php');
}



$conn->close();
?>
