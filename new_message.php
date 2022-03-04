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

$id = 0;

$sql = "SELECT sentby, sentto FROM Messages";
$res = $conn->query($sql);
if (!(empty($res))) {
    while ($row = $res->fetch_assoc()) {
        if ($row['sentto'] == $_SESSION['username']) {
            $id += 1;
            $_SESSION['sentby'] = $row['sentby'];
        }
    }
    $_SESSION['newmessages'] = $id;
    echo 'You have '.$id.' message from '.$_SESSION['sentby'];
}



$conn->close();
?>
