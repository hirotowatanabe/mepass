<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$id = '';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('Location: /');
    exit();
}

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    if($_GET['flag'] == 'follow'){
        $sql = " insert into t_follow ";
        $sql .= " values('".$UserMail."', ".$id.") ";
    }else if($_GET['flag'] == 'unfollow'){
        $sql = " delete from t_follow ";
        $sql .= " where mem_mail = '".$UserMail."' ";
        $sql .= " and store_num = ".$id;
    }
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;

header('Location: /user/store.php?id='.$id);
exit();
?>
