<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " update t_company_member ";
    $sql .= " set ";
    $sql .= " com_mem_pass = '".$_SESSION['comMemUpdate']['comMemPass']."', ";
    $sql .= " com_mem_name_kanji = '".$_SESSION['comMemUpdate']['comMemNameKanji']."', ";
    $sql .= " com_mem_name_furigana = '".$_SESSION['comMemUpdate']['comMemNameFurigana']."', ";
    $sql .= " store_num = ".$_SESSION['comMemUpdate']['storeNum'];
    $sql .= " where ";
    $sql .= " com_mem_num = ".$_SESSION['comMemUpdate']['comMemNum'];
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;

unset($_SESSION['comMemUpdate']);

header('Location: /company/user/update/result.php');
exit();
?>
