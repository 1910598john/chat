<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = 'test';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$alignment = null;
$bgc = null;
$font_color = null;

$sql = "SELECT id, avatar, message, sendername, sentby FROM groupchat";
$res = $conn->query($sql);


//<div style="width:15px;height:15px;background:#199c31;border-radius:50%;position:absolute;left:65%;top:60%;border:2px solid #1c1e21;"></div>
if (($res->num_rows > 0) && (!empty($res))) {
    while ($row = $res->fetch_assoc()) {
        if ($row['sentby'] != $_SESSION['myusername']) {
            $alignment = 'justify-content: flex-start';
            $bgc = '#E4E6EB';
            $font_color = '#050505';
            echo '  <div class="message-wrapper">
                    <div class="username" style="display:none;">'.$row['sentby'].'</div>
                    <div id="message'.$row['id'].'" class="message '.$row['sentby'].'" style="align-items:center;display:flex;'.$alignment.';margin:20px 0 30px 10px;">
                        <div class="avatar '.$row['sentby'].'" style="width:30px;height:30px;border-radius:50%;margin: 0 10px 0 0;position:relative;">
                            
                            <img src="'.$row['avatar'].'" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
                            
                        </div>
                        
                        <div style="position:relative;max-width:37%;overflow-wrap:break-word;background:'.$bgc.';font-size:13px;color:'.$font_color.';padding:7px;border-radius:10px;"><span style="width:135px;color:rgb(202, 201, 201);font-size:11px;position:absolute;bottom:calc(100% + 3px);left:20px;">'.$row['sendername'].'</span>'.stripslashes($row['message']).'</div>
                    </div>
                </div>';
        }
        else {
            $alignment = 'justify-content: flex-end';
            $bgc = '#1877f2';
            $font_color = '#fff';
            echo '  <div class="message-wrapper">
                    <div id="message'.$row['id'].'" class="message '.$row['sentby'].'" style="align-items:center;display:flex;'.$alignment.';margin:15px 10px 15px 0;">
                        <div style="max-width:37%;overflow-wrap:break-word;background:'.$bgc.';font-size:13px;color:'.$font_color.';padding:7px;border-radius:10px;">'.$row['message'].'</div>
                    </div>
                </div>';
        }
        
    }
}


$conn->close();
?>
