<?php
session_start();
session_unset($_SESSION["company"]);
header("Location: /company/account/login/");
exit();

//  HTTPヘッダーで文字コードを指定
//header("Content-Type:text/html; charset=UTF-8");
?>
