<?php
session_start();
unset($_SESSION["sadminId"]);
header("Location: /sadmin/account/login/");
exit;

//  HTTPヘッダーで文字コードを指定
//header("Content-Type:text/html; charset=UTF-8");
?>
