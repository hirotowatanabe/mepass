<?php
session_start();

$UserMail = $UserName = '';

//セッションにログイン情報が保存されているか判定
if(isset($_SESSION['user']["userMail"])){
    //保存されている場合、ログイン情報を変数に格納
    $UserMail = $_SESSION['user']['userMail'];
    $UserName = $_SESSION['user']['userName'];
}else if(isset($loginRequired)){
    if($loginRequired == 'true'){
        //ログイン必須の場合、ログインページにリダイレクト
        header('Location: /user/account/login/?err=3');
        exit();
    }
}
?>
