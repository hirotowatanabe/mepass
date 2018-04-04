<?php
header('Content-Type:text/html; charset=UTF-8');
//ログイン必須
$loginRequired = 'true';
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pay = $datetime = '';
if(isset($_POST['pay'])){
    $pay = $_POST['pay'];
}else{
    $pay = 'credi';
}

$datetime = $_SESSION['order']['date'].' '.$_SESSION['order']['time'];

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " insert into t_order(order_pay, order_datetime, mem_mail) ";
    $sql .= " values('".$pay."', '".$datetime."', '".$UserMail."')";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    $orderNum = $dbh->lastInsertId();
    foreach($_SESSION['ticket'] as $id => $value){
        $sql = " insert into t_order_ticket values(".$orderNum.", ".$id.", ".$value.", '1') ";
        $stmt = $dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
    }
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;
unset($_SESSION['order']);
unset($_SESSION['ticket']);
unset($_SESSION['total']);
unset($_SESSION['storeSelect']);

header('Location: /user/order/ex.php?id='.$orderNum);
exit();
?>
