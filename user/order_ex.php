<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = '注文完了';
$msg = '';
$pay = '';
$date = '';
$time = '';
$datetime = '';
$mail = '';
if(isset($_POST['btn'])){
    $pay = $_POST['pay'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $datetime = $date.' '.$time;
    if(isset($_POST['mail'])){
        $mail = $_POST['mail'];
    }else{
        $mail = $UserMail;
    }

    include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
    try{
        $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
        if($dbh == null){
            exit('DB接続失敗');
        }
        $dbh->query('set names utf8');
        $sql = " insert into t_order(order_pay, order_datetime, mem_mail) ";
        $sql .= " values('".$pay."', '".$datetime."', '".$mail."')";
        $stmt = $dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        $order_num = $dbh->lastInsertId();
        foreach($_SESSION['ticket'] as $id => $value){
            $sql = " insert into t_order_ticket values(".$order_num.", ".$id.", ".$value.", '1') ";
            $stmt = $dbh->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $stmt->rowCount();
        }
    }catch(PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
    $dbh = null;
    unset($_SESSION['ticket']);
    unset($_SESSION['total']);
    unset($_SESSION['storeSelect']);
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main">
        <div class="user-main-ticket-top">
            <h3 class="user-main-ticket-top__title">注文が完了しました。</h3>
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
        <section class="user-main-form__section">
            <h4 class="user-main-form__title">注文番号</h4>
            <?= $order_num ?>
        </section>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
