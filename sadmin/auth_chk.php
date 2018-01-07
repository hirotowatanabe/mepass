<?php
$sadminId = "";
session_start();

//セッションにログイン情報が保存されているか判定
if(isset($_SESSION["sadminId"])){
    //保存されている場合、ログイン情報を変数に格納
    $sadminId = $_SESSION["sadminId"];
}else{
    header("Location: /sadmin/account/login/");
}
?>
