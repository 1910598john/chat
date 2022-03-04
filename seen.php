<?php
session_start();
$id = intval($_SESSION['newmessages']);
$id = 0;
$_SESSION['newmessages'] = $id;
?>