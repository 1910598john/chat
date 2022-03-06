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
        <div id="refresh" style="text-align:left;"><i class="fa-solid fa-rotate" style="cursor:pointer;font-size:1.2em;color:rgb(51, 50, 50)"></i></div>
        <div class="profile" style="text-align:right;"><i class="fa-solid fa-user" style="cursor:pointer;font-size:1.2em;color:rgb(51, 50, 50)"></i></div>
        <div class="main-wrapper">
            <div class="inner">
                <div class="online active-people" id="active">ONLINE</div>
                
                <div class="message-tab" id="message-tab" style="position:relative">
                    <i class="fa-brands fa-facebook-messenger" style="position:absolute;color:rgb(51, 50, 50);font-size:1.8em;top:50%;left:50%;transform:translate(-50%,-50%);"><div id="message-notif" style="display:none;border-radius:50%;background:red;position:absolute;left:60%;bottom:60%;font-size:11px;width:17px;height:17px;padding:2px 4px;border:2px solid rgb(202, 201, 201);color:rgb(202, 201, 201);">0</div></i>
                </div>
            </div>
            <div class="container" id="container">
                    
            </div>
        </div>
    </div>
</div>

<script src="active.js"></script>
</body>
</html>
