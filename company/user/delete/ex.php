<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$num = '';

if(isset($_GET['num'])){
    $num = $_GET['num'];
}

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " delete from t_company_member ";
    $sql .= " where com_mem_num = ".$num;
    $stmt = $dbh->query($sql);
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $rows[] = $result;
    }
    $count = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;

header('Location: /company/user/delete/result.php');
exit();
?>
