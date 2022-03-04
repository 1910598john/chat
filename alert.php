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

$chosen = $_SESSION['chosen'];
$user = $_SESSION['username'];
$convo = $chosen.$user;

$sql = "SELECT id, sentto FROM ".$convo;
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    if ($row['id'] == $_SESSION['lastId']) {
        echo '<script>alert("you have a message")</script>';
    }
}

$conn->close();
?>
