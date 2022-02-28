<?php

session_start();
if (!(isset($_SESSION['bool']))) {
    header('location: active.php');
}


?>


<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <!--
    <div class="wrapper" style="font-size:2em;font-family:sans-serif;">
        <p id="active-user"></p>
        <input type="text" id="input">
        <button>Test button</button>
        <div id="message-wrapper"></div>
    </div>  -->
<script src="chat.js"></script>
</body>
</html>