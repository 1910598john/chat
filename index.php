<?php

session_start();
if (isset($_SESSION['myname'])) {
    header('Location: active.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="form">
    <div class="form-wrapper">
        <div class="login" id="login">
            <div class="login-wrapper">
                <span>Login</span>
                <input type="text" placeholder="Username" id="username">
                <input type="password" placeholder="Password" id="password">
                <button id="login-confirm">Login</button> 
                <span style="font-size:.8em;color:gray;margin: 10px 0;">Don't have an account? <a>Sign-Up</a></span>
            </div>
        </div>
        <div class="register" id="register">
            <div class="register-wrapper">
                <span>Register</span>
                <input type="text" placeholder="Name" id="reg-name">
                <input type="text" placeholder="Username" id="reg-username">
                <input type="password" placeholder="Password" id="reg-password">
                <button id="register-confirm">Sign-Up</button> 
                <span style="font-size:.8em;color:gray;margin: 10px 0;">Already have an account? <a>Login</a></span>
            </div>
        </div>
    </div>
</div>
<!--
<div class="body-wrapper">
    <div class="user-name">
        <span>Enter your name:</span>
        <input type="text" id="name">
        <button>wew</button>
    </div>
</div>  -->
<script src="index.js"></script>
</body>
</html>
