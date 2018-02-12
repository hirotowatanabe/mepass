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
    $sql = " insert into t_store ";
    $sql .= " (store_name, store_post, store_pref, store_city, store_add, store_tel, com_id) ";
    $sql .= " values ";
    $sql .= " ( ";
    $sql .= " '".$_SESSION['storeCreate']['storeName']."', ";
    $sql .= " '".$_SESSION['storeCreate']['storePost']."', ";
    $sql .= " '".$_SESSION['storeCreate']['storePref']."', ";
    $sql .= " '".$_SESSION['storeCreate']['storeCity']."', ";
    $sql .= " '".$_SESSION['storeCreate']['storeAdd']."', ";
    $sql .= " '".$_SESSION['storeCreate']['storeTel']."', ";
    $sql .= " '".$comId."' ";
    $sql .= " ) ";
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

unset($_SESSION['storeCreate']);

header('Location: /company/store/create/result.php');
exit();
?>
