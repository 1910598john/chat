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


$sql = "SELECT name, username, status from Names";
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    if (!($row['name'] == $_SESSION['myname'])) {
        if ($row['status'] == 'online') {
            echo '<div class="user-container" style="cursor:pointer;display:flex;justify-content:space-between;padding:5px 20px;">
                <div class="user" style="color:#fff;">'.$row["name"].'</div>
                <div class="username" style="color:#fff;display:none;">'.$row["username"].'</div>
                <div class="status-wrapper"><span style="color:#0da33d;">'.$row['status'].'</span></div>
            </div>';
        }
        else {
            echo '<div class="user-container" style="cursor:pointer;display:flex;justify-content:space-between;padding:5px 20px;">
                <div class="user" style="color:#fff;">'.$row["name"].'</div>
                <div class="username" style="color:#fff;display:none;">'.$row["username"].'</div>
                <div class="status-wrapper"><span style="color:#b0463a;">'.$row['status'].'</span></div>
            </div>';
        }
    }
}

$conn->close();
?>
