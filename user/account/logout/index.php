<?php
header('Content-Type:text/html; charset=UTF-8');
$reUrl = $_SERVER['HTTP_REFERER'];
session_start();
unset($_SESSION['user']);
header('Location: '.$reUrl);
exit();
?>
