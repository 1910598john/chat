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

$alignment = null;
$bgc = null;
$font_color = null;

$sql = "SELECT id, message, sentby FROM groupchat";
$res = $conn->query($sql);

if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        if ($row['sentby'] != $_SESSION['myusername']) {
            $alignment = 'justify-content: flex-start';
            $bgc = '#E4E6EB';
            $font_color = '#050505';
        }
        else {
            $alignment = 'justify-content: flex-end';
            $bgc = '#1877f2';
            $font_color = '#fff';
        }
        echo '<div id="group-message'.$row['id'].'" class="group-message '.$row['sentby'].'" style="display:flex;'.$alignment.';margin:10px">
                  <div style="max-width:40%;overflow-wrap:break-word;background:'.$bgc.';color:'.$font_color.';padding:7px;border-radius:10px;font-size:12px;">'.$row['message'].'</div>
              </div>';
    }
}


$conn->close();
?>
