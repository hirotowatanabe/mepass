<?php
header('Content-Type:text/html; charset=UTF-8');

if(!isset($_POST['btn'])){
    exit('不正アクセスを検知しました。');
}

$id = $pass = '';
$id = $_POST['id'];
$pass = $_POST['pass'];

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " select * from t_company where com_id='".$id."' ";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;

if($result != 0){
    if($result['com_pass'] == $pass){
        session_start();
        $_SESSION['company']['comId'] = $result['com_id'];
        $_SESSION['company']['comName'] = $result['com_name'];
        header('Location: /company/');
        exit();
    }else{
        header('Location: /company/account/login/?err=1&id='.$id);
        exit();
    }
}else{
    header('Location: /company/account/login/?err=2&id='.$id);
    exit();
}
?>
