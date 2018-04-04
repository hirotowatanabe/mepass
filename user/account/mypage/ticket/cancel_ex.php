<?php
header('Content-Type:text/html; charset=UTF-8');
//ログイン必須
$loginRequired = 'true';
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');

$allCancel = $orderNum = $menuNum = '';

if(isset($_GET['allCancel'])){
    $allCancel = $_GET['allCancel'];
    $orderNum = $_GET['orderNum'];
    if($allCancel == 'no'){
        $menuNum = $_GET['menuNum'];
    }
}else{
    header('Location: /user/account/mypage/');
    exit();
}

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    if($allCancel == 'yes'){
        //一括キャンセル
        $sql = " update t_order_ticket ";
        $sql .= " set ot_status = '3' ";
        $sql .= " where order_num = ".$orderNum;
    }else if($allCancel == 'no'){
        //個別キャンセル
        $sql = " update t_order_ticket ";
        $sql .= " set ot_status = '3' ";
        $sql .= " where order_num = ".$orderNum;
        $sql .= " and menu_num = ".$menuNum;
    }
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;

header('Location: /user/account/mypage/ticket/cancel_result.php');
exit();
?>
