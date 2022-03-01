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
$user = $_SESSION['username'];
$convo = $chosen.$user;

$sql = "SELECT id, message, sentby FROM ".$convo;
$res = $conn->query($sql);

$alignment = null;
$bgc = null;
$font_color = null;
if (!empty($res) && $res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        if ($row['sentby'] == $chosen) {
            $alignment = 'justify-content: flex-start';
            $bgc = '#e8e4e3';
            $font_color = '#2b1e16';
        }
        else {
            $alignment = 'justify-content: flex-end';
            $bgc = '#1877f2';
            $font_color = '#fff';
        }
        echo '<div id="message'.$row['id'].'" class="message '.$row['sentby'].'" style="display:flex;'.$alignment.';margin:10px">
                  <div style="max-width:50%;overflow-wrap:break-word;background:'.$bgc.';color:'.$font_color.';padding:10px;border-radius:10px;">'.$row['message'].'</div>
              </div>';
        $_SESSION['lastId'] = $row['id'];
    }
}

$conn->close();
?>
