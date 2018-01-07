<?php
session_start();
$UserMail = "";
$UserName = "";

//セッションにログイン情報が保存されているか判定
if(isset($_SESSION["company"])){
    //保存されている場合、ログイン情報を変数に格納
    $comNum = $_SESSION["company"]["comNum"];
    $comName = $_SESSION["company"]["comName"];
}else{
    header("Location: /company/account/login/");
    exit();
}
?>
