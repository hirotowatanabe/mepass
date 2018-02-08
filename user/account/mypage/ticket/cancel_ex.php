<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = '注文キャンセル完了';

if($UserMail == ''){
    header('Location: /');
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
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
    $sql = " delete from t_order where order_num = ".$id;
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    $sql2 = " delete from t_order_ticket where order_num = ".$id;
    $stmt = $dbh->query($sql2);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;
?>
<!DOCTYPE html>
<html lang="ja">
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php"); ?>
    <main class="user-main user-mypage">
        <section class="user-mypage-section">
            <h2 class="user-mypage-section__title">注文のキャンセルが完了しました。</h1>
            <a href="/user/account/mypage/">マイページトップ</a>
        </section>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
</body>
</html>
