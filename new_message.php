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
$chosen = null;
$user = null;
$convo = null;
$lastid = null;
$id = null;

if (isset($_SESSION['chosen'])) {
    $chosen = $_SESSION['chosen'];
    $user = $_SESSION['username'];
    $convo = $chosen.$user;
    $lastid = $_SESSION['lastId'];
    $id = 0;
}

if (isset($_SESSION['msg'])) {
    $id = intval($_SESSION['msg']);
}




$sql = "SELECT sentto FROM ".$convo. " WHERE id = ".$lastid;
$res = $conn->query($sql);

if (!empty($res) && $res->num_rows > 0) {
    $row = $res->fetch_assoc();
    if ($row['sentto'] == $user) {
        echo 'You have a message';
    }
}

$conn->close();
?>
