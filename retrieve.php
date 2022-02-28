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
$user = $_SESSION['user'];
$convo = $chosen.$user;

$sql = "SELECT message FROM ".$convo;
$res = $conn->query($sql);

if (!empty($res) && $res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        echo '<div class="message" style="display:flex;justify-content:flex-end;margin:10px">
                  <div style="max-width:50%;overflow-wrap:break-word;background:#1877f2;color:#fff;padding:10px;border-radius:10px;">'.$row['message'].'</div>
              </div>';
    }
}

$conn->close();
?>
