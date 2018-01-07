<?php
session_start();
$UserMail = "";
$UserName = "";

//セッションにログイン情報が保存されているか判定
if(isset($_SESSION["comMem"])){
    //保存されている場合、ログイン情報を変数に格納
    $comMemNum = $_SESSION["comMem"]["comMemNum"];
    $comMemName = $_SESSION["comMem"]["comMemName"];
}else{
    header("Location: /store/account/login/");
    exit();
}
?>
