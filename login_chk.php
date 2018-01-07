<?php
//処理部
$UserMail = "";
$UserName = "";
session_start();

//セッションにログイン情報が保存されているか判定
if(isset($_SESSION["user"]["userMail"])){
    //保存されている場合、ログイン情報を変数に格納
    $UserMail = $_SESSION["user"]["userMail"];
    $UserName = $_SESSION["user"]["userName"];
}
?>
