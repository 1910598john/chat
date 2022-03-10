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
$status = array();
$names = array();
$avatars = array();
$message = array();
$sql = "SELECT avatar, message, messagefrom, sentby, sentto FROM Messages";
$res = $conn->query($sql);

//<div style="width:18px;height:18px;background:#199c31;border-radius:50%;position:absolute;left:70%;top:60%;border:2px solid #1c1e21;"></div>

if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        if ($row['sentby'] != $_SESSION['myusername'] && $row['sentto'] == $_SESSION['myusername']) {
            array_push($usernames, $row['sentby']);
            array_push($names, $row['messagefrom']);
            array_push($avatars, $row['avatar']);
            array_push($message, $row['message']);
        }
        
    }
    
    $usernames_newarr = array_unique($usernames);
    $names_newarr = array_unique($names);
    $avatars_newarr = array_unique($avatars);
    $message_newarr = array_unique($message);
    $len = count($names_newarr);
    
    for ($x = 0; $x < $len; $x++) {

        echo '<div class="user-container" style="cursor:pointer;display:flex;justify-content:space-between;padding:5px 20px;">';
        echo    '<img src="'.$avatars_newarr[$x].'" style="display:none;">';
        echo    '<div class="this-user-name" style="display:none;">'.$names_newarr[$x].'</div>';
        echo    '<div class="user" style="display:flex;flex-direction: row;align-items:center;">
                    <div class="avatar '.$usernames_newarr[$x].'" style="width:40px;height:40px;border-radius:50%;margin: 0 10px 0 0;position:relative;">
                        <img src="'.$avatars_newarr[$x].'" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
                    </div>
                    <div class="name-and-message" style="display:flex;flex-direction:column;overflow:hidden;max-width:100%;max-height:45px;">
                        <span style="color:#fff;width:200px;">'.$names_newarr[$x].'</span>
                        <span style="color:gray;font-size:12px;max-width:50%;overflow:hidden;">'.$message_newarr[$x].'</span>
                    </div>
                    
                </div>';
        echo    '<div class="username" style="color:#fff;display:none;">'.$usernames_newarr[$x].'</div>';  
        echo '</div>';
        
    } 
    
    
}
$conn->close();
?>
