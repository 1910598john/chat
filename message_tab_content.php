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


$usernames = array();
$names = array();
$sql = "SELECT message, messagefrom, sentby, sentto FROM Messages";
$res = $conn->query($sql);


if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        if ($row['sentby'] != $_SESSION['username'] && $row['sentto'] == $_SESSION['username']) {
            array_push($usernames, $row['sentby']);
            array_push($names, $row['messagefrom']);
        }
    }
    
    $usernames_newarr = array_unique($usernames);
    $names_newarr = array_unique($names);
    $len = count($names_newarr) - 1;
    
    foreach ($names_newarr as $val) {
        echo '<div class="user-container" style="cursor:pointer;display:flex;justify-content:space-between;padding:5px 20px;">';
        echo    '<div class="user" style="color:rgb(202, 201, 201);">'.$val.'</div>';
        /*echo    '<div class="username" style="color:#fff;display:none;">'.$usernames_newarr[$x].'</div>';  */
        echo '</div>';
    }
    
}
$conn->close();
?>
