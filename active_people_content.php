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


echo '<div class="active-people-content" id="active-people-content">';
while ($row = $res->fetch_assoc()) {
    if (!($row['name'] == $_SESSION['myname'])) {
        if ($row['status'] == 'online') {
            echo '<div class="user-container" style="cursor:pointer;display:flex;justify-content:space-between;padding:5px 20px;">
            <div class="user"><div style="width:40px;height:40px;border-radius:50%;><img src="images/askeladd.jpg" style="width:100%;height:100%;border-radius:50%;object-fit:cover;"></div><span style="color:rgb(202, 201, 201);">'.$row["name"].'</span></div>
                <div class="username" style="color:#fff;display:none;">'.$row["username"].'</div>
                <div class="status-wrapper"><span style="color:#0da33d;">'.$row['status'].'</span></div>
            </div>';
        }
        else {
            echo '<div class="user-container" style="cursor:pointer;display:flex;justify-content:space-between;padding:5px 20px;">
                <div class="user"><div style="width:40px;height:40px;border-radius:50%;><img src="images/askeladd.jpg" style="width:100%;height:100%;border-radius:50%;object-fit:cover;"></div><span style="color:rgb(202, 201, 201);">'.$row["name"].'</span></div>
                <div class="username" style="color:#fff;display:none;">'.$row["username"].'</div>
                <div class="status-wrapper"><span style="color:#b0463a;">'.$row['status'].'</span></div>
            </div>';
        }
    }
}
echo '</div>';
$conn->close();
?>