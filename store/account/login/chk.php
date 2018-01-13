<?php
header('Content-Type:text/html; charset=UTF-8');
$num = '';
$pass = '';

if(isset($_POST['btn'])){
    $num = $_POST['num'];
    $pass = $_POST['pass'];
    include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
    try{
        $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
        if($dbh == null){
            exit('DB接続失敗');
        }
        $dbh->query('set names utf8');
        $sql = "select * from t_company_member where com_mem_num='".$num."'";
        $stmt = $dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
    }catch(PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
    $dbh = null;

    if($count != 0){
        if($result['com_mem_pass'] == $pass){
            session_start();
            $_SESSION['comMem']['comMemNum'] = $result['com_mem_num'];
            $_SESSION['comMem']['comMemName'] = $result['com_mem_name_kanji'];
            $_SESSION['comMem']['storeNum'] = $result['store_num'];
            header('Location: /store/');
            exit();
        }else{
            header('Location: /store/account/login/?err=1');
            exit();
        }
    }else{
        header('Location: /store/account/login/?err=2');
        exit();
    }
}
?>
