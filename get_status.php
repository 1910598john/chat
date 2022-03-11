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

$sql = "SELECT name, username, status FROM names";
$res = $conn->query($sql);
$d2 = array();
$name = array();
$username = array();
$status = array();
while ($row = $res->fetch_assoc()) {
    array_push($name, $row['name']);
    array_push($username, $row['username']);
    array_push($status, $row['status']);
}
$d2[0] = $name;
$d2[1] = $username;
$d2[2] = $status;

$json = json_encode($d2);
echo $json;

$conn->close();
?>
