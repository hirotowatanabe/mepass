<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = '店舗情報管理';
$id = '';

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
include($_SERVER['DOCUMENT_ROOT']."/mysqlenv.php");
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " select * from t_store ";
    $sql .= " where ";
    $sql .= " store_num = ".$id;
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;

?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php') ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/company/header.php'); ?>
    <div class="admin-content">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/company/gnav.php'); ?>
    <main class="admin-main">
        <?php if($count != 0): ?>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">店舗情報</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">店舗名</h3>
                    <span class="application-main-disp__value"><?= $result['store_name'] ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">所在地</h3>
                    <span class="application-main-disp__value">〒<?= $result['store_post'] ?><br>
                    <?= $result['store_pref'].$result['store_city'].$result['store_add'] ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">お問い合わせ先電話番号</h3>
                    <span class="application-main-disp__value"><?= $result['store_tel'] ?></span>
                </div>
            </section>
        <?php else: ?>
            <p>該当店舗は存在しません。</p>
        <?php endif; ?>
    </main>
</div>
</body>
</html>
