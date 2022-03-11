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


$sql = "SELECT avatar, name, username, status from Names";
$res = $conn->query($sql);


if (($res->num_rows > 0) && (!(empty($res)))) {
    echo '<div class="active-people-content" id="active-people-content">';
    while ($row = $res->fetch_assoc()) {
        if (!($row['name'] == $_SESSION['myname']) && $row['status'] == 'offline') {
                
                echo '  <div class="user-container" style=";cursor:pointer;display:flex;justify-content:space-between;padding:5px 20px 5px 10px;align-items:center;">
                            <div class="this-user-name" style="display:none;">'.$row["name"].'</div>
                            <img src="'.$row["avatar"].'" style="display:none;">
                            <div class="user" style="display:flex;flex-direction: row;align-items:center;">
                                <div style="width:40px;height:40px;border-radius:50%;margin: 0 10px 0 0;">
                                    <img src="'.$row['avatar'].'" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
                                </div>    
                                <span style="color:rgb(202, 201, 201);">'.$row["name"].'</span>
                            </div>
                            <div class="username" style="color:#fff;display:none;">'.$row["username"].'</div>
                            <div class="status-wrapper"><span style="color:#b0463a;">'.$row['status'].'</span></div>
                        </div>';
            
        }
    }
    echo '</div>';
}

$conn->close();
?>