<?php
header('Content-Type:text/html; charset=UTF-8');
session_start();
unset($_SESSION['comMem']);
header('Location: /store/account/login/');
exit();
?>
