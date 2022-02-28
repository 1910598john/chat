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


?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2f8a9e5e8e.js" crossorigin="anonymous"></script>
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <meta charset=“UTF-8”>
    <link rel="stylesheet" href="active.css">
</head>
<body onbeforeunload="func()" onload="load()">
<div class="body-container">
    <div class="main" id="main">
        <div class="profile" style="text-align:right;"><i class="fa-solid fa-user" style="cursor:pointer;font-size:1.2em;color:rgb(51, 50, 50)"></i></div>
        <div class="main-wrapper">
            <div class="inner">
                <div class="online active-people" id="active">ACTIVE</div>
                <div class="message-tab" id="message-tab" style="position:relative"><i class="fa-brands fa-facebook-messenger" style="position:absolute;color:rgb(51, 50, 50);font-size:2em;top:50%;left:50%;transform:translate(-50%,-50%);"></i></div>
            </div>
            <div class="container" id="container">
            <?php

            $sql = "SELECT name, status from Names";
            $res = $conn->query($sql);

            while ($row = $res->fetch_assoc()) {
                if (!($row['name'] == $_SESSION['user'])) {
                    if ($row['status'] == 'online') {
                        echo '<div class="user-container" style="cursor:pointer;display:flex;justify-content:space-between;padding:5px 20px;">
                            <div class="user" style="color:#fff;">'.$row["name"].'</div>
                            <div class="status-wrapper"><span style="color:#0da33d;">'.$row['status'].'</span></div>
                        </div>';
                    }
                    else {
                        echo '<div class="user-container" style="cursor:pointer;display:flex;justify-content:space-between;padding:5px 20px;">
                            <div class="user" style="color:#fff;">'.$row["name"].'</div>
                            <div class="status-wrapper"><span style="color:#b0463a;">'.$row['status'].'</span></div>
                        </div>';
                    }
                }
            }


            ?>
            </div>
        </div>
    </div>
</div>

<script src="active.js"></script>
</body>
</html>
