<?php

session_start();

$id = intval($_SESSION['id']);

$id = 0;

$_SESSION['id'] = $id;

?>