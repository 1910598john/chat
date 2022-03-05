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



$sql = "SELECT sentby, sentto FROM Messages";
$res = $conn->query($sql);

$id = 0;
$arr = array();
$newarr = null;
$int = null;


if (!(empty($res)) && ($res->num_rows > 0)) {
    while ($row = $res->fetch_assoc()) {
        if ($row['sentby'] != $_SESSION['username'] && $row['sentto'] == $_SESSION['username']) {
            array_push($arr, $row['sentby']);
        }
    }
    $newarr = array_unique($arr);
    echo count($newarr);
}


$conn->close();
?>
