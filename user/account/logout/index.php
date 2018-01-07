<?php
$ReUrl = $_SERVER['HTTP_REFERER'];

session_start();
session_unset($_SESSION["user"]);
header("Location: ".$ReUrl);
exit;

//  HTTPヘッダーで文字コードを指定
//header("Content-Type:text/html; charset=UTF-8");
?>
