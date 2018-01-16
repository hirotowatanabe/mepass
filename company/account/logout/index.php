<?php
header('Content-Type:text/html; charset=UTF-8');
session_start();
unset($_SESSION['company']);
header('Location: /company/account/login/');
exit();
?>
