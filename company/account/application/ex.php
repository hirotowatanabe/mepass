<?php
session_start();
header('Content-Type:text/html; charset=UTF-8');

if(!isset($_GET['ex'])){
    exit('不正なアクセスを検知しました。');
}

include($_SERVER['DOCUMENT_ROOT']."/mysqlenv.php");
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " insert into t_company ";
    $sql .= " (com_id, com_pass, com_name, com_post, com_pref, com_city, com_add, com_tel, com_mail) ";
    $sql .= " values ";
    $sql .= " ( ";
    $sql .= " '".$_SESSION["application"]["comId"]."', ";
    $sql .= " '".$_SESSION["application"]["comPass"]."', ";
    $sql .= " '".$_SESSION["application"]["comName"]."', ";
    $sql .= " '".$_SESSION["application"]["comPost"]."', ";
    $sql .= " '".$_SESSION["application"]["comPref"]."', ";
    $sql .= " '".$_SESSION["application"]["comCity"]."', ";
    $sql .= " '".$_SESSION["application"]["comAdd"]."', ";
    $sql .= " '".$_SESSION["application"]["comTel"]."', ";
    $sql .= " '".$_SESSION["application"]["comMail"]."' ";
    $sql .= " ) ";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;

$_SESSION["company"]["comId"] = $_SESSION["application"]["comId"];
$_SESSION["company"]["comName"] = $_SESSION["application"]["comName"];

unset($_SESSION["application"]);

header('Location: /company/account/application/result.php');
exit();
?>
