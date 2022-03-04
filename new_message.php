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
$arr = array();
$newarr = null;
$to = null;

$sql = "SELECT sentby, sentto FROM Messages";
$res = $conn->query($sql);
if (!(empty($res))) {
    while ($row = $res->fetch_assoc()) {
        if ($row['sentto'] == $_SESSION['username']) {
            array_push($arr, $row['sentto']);
            $newarr = array_unique($arr);
            for($x = 0; $x < count($newarr); $x++) {
                $id += 1;
            }
        }
    }
    echo $id;
}



$conn->close();
?>
