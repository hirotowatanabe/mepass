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
    $sql = " insert into t_company_member ";
    $sql .= " (com_mem_pass, com_mem_name_kanji, com_mem_name_furigana, com_id, store_num) ";
    $sql .= " values ";
    $sql .= " ( ";
    $sql .= " '".$_SESSION['comMemCreate']['comMemPass']."', ";
    $sql .= " '".$_SESSION['comMemCreate']['comMemNameKanji']."', ";
    $sql .= " '".$_SESSION['comMemCreate']['comMemNameFurigana']."', ";
    $sql .= " '".$comId."', ";
    $sql .= $_SESSION['comMemCreate']['storeNum'];
    $sql .= " ) ";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    $comMemNum = $dbh->lastInsertId('com_mem_num');
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;

unset($_SESSION['comMemCreate']);

header('Location: /company/user/create/result.php?comMemNum='.$comMemNum);
exit();
?>
