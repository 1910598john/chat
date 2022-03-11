<?php
session_start();
$servername = "sql108.epizy.com";
$username = "epiz_31214209";
$password = "8XgUo6PEhYV1N";
$database = 'epiz_31214209_mydb';

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
        if ($row['sentby'] != $_SESSION['myusername'] && $row['sentto'] == $_SESSION['myusername']) {
            array_push($arr, $row['sentby']);
        }
    }
    $newarr = array_unique($arr);
    echo count($newarr);
}


$conn->close();
?>
