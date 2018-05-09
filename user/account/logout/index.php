<?php
header('Content-Type:text/html; charset=UTF-8');
$reUrl = $_SERVER['HTTP_REFERER'];
if(isset($_GET['redirect'])){
    if($_GET['redirect'] == 'top'){
        $reUrl = '/';
    }
}
session_start();
unset($_SESSION['user']);
header('Location: '.$reUrl);
exit();
?>
