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

$chosen = null;
$user = null;
if (isset($_SESSION['chosen'])) {
    $chosen = $_SESSION['chosen'];
    $user = $_SESSION['myusername'];
}
$convo = $chosen.$user;
$alignment = null;
$bgc = null;
$font_color = null;

$sql = "SELECT id, avatar, message, sentby FROM ".$convo;
$res = $conn->query($sql);
//<div style="width:15px;height:15px;background:#199c31;border-radius:50%;position:absolute;left:65%;top:60%;border:2px solid #1c1e21;"></div>

if (!(empty($res))) {
    while ($row = $res->fetch_assoc()) {
        if ($row['sentby'] == $chosen) {
            $alignment = 'justify-content: flex-start';
            $bgc = '#E4E6EB';
            $font_color = '#050505';
            echo '  <div class="message-wrapper">
                <div id="message'.$row['id'].'" class="message '.$row['sentby'].'" style="align-items:center;display:flex;'.$alignment.';margin:10px 0;">
                    <div class="avatar '.$row['sentby'].'" style="width:30px;height:30px;border-radius:50%;margin: 0 10px 0 0;position:relative;">
                        <img src="'.$row['avatar'].'" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
                    </div>
                    <div style="max-width:50%;overflow-wrap:break-word;background:'.$bgc.';color:'.$font_color.';padding:10px;border-radius:10px;">'.$row['message'].'</div>
                </div>
            </div>';
        }
        else {
            $alignment = 'justify-content: flex-end';
            $bgc = '#1877f2';
            $font_color = '#fff';
            echo '  <div class="message-wrapper">
                    <div id="message'.$row['id'].'" class="message '.$row['sentby'].'" style="align-items:center;display:flex;'.$alignment.';margin:10px 0;">
                        <div style="max-width:50%;overflow-wrap:break-word;background:'.$bgc.';color:'.$font_color.';padding:10px;border-radius:10px;">'.$row['message'].'</div>
                    </div>
                </div>';
        }
        
        $_SESSION['lastId'] = $row['id'];
    }
}

$conn->close();
?>
