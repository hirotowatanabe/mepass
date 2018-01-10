<?php
header('Content-Type:text/html; charset=UTF-8');
$mail = '';
$pass = '';
$reUrl = '';

if(isset($_POST['btn'])){
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $reUrl = $_POST['reUrl'];
    include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
    try{
        $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
        if($dbh == null){
            exit('DB接続失敗');
        }
        $dbh->query('set names utf8');
        $sql = "select * from t_member where mem_mail='".$mail."'";
        $stmt = $dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
    }catch(PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
    $dbh = null;

    if($count != 0){
        if($result['mem_pass'] == $pass){
            session_start();
            $_SESSION['user']['userMail'] = $result['mem_mail'];
            $_SESSION["user"]['userName'] = $result['mem_name_kanji'];
            header('Location: '.$reUrl);
            exit();
        }else{
            header('Location: /user/account/login/?err=1&reUrl='.$reUrl);
            exit();
        }
    }else{
        header('Location: /user/account/login/?err=2&reUrl='.$reUrl);
        exit();
    }
}
?>
