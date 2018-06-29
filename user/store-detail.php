<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = '店舗';
$id = $msg = '';

if(isset($_POST['id'])){
    $id = $_POST['id'];
}else if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('Location: /');
    exit();
}

if(isset($_GET['select'])){
    $msg = '追加しました。<a class="user-main-msg__link" href="/user/ticket.php">選択中のチケットを確認する。</a>';
}

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $storeSql = " select * from t_store ";
    $storeSql .= " where store_num = ".$id;
    $stmt = $dbh->query($storeSql);
    $storeResult = $stmt->fetch(PDO::FETCH_ASSOC);
    $storeCount = $stmt->rowCount();
    if($UserMail != ''){
        $followSql = " select * from t_follow ";
        $followSql .= " where mem_mail = '".$UserMail."' ";
        $followSql .= " and store_num = ".$id;
        $stmt = $dbh->query($followSql);
        $followResult = $stmt->fetch(PDO::FETCH_ASSOC);
        $followCount = $stmt->rowCount();
    }
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>
    <main class="user-main">
        <div class="store-header">
            <div class="store-header__info">
                <h3 class="store-header__title"><?= $storeResult['store_name'] ?></h3>
                <?php if($UserMail != ''): ?>
                    <?php if($followCount == 0): ?>
                    <a class="store-header__button" href="/user/follow.php?flag=follow&id=<?= $storeResult['store_num'] ?>&back=detail">店舗をフォロー</a>
                    <?php else: ?>
                    <a class="store-header__button is-follow" href="/user/follow.php?flag=unfollow&id=<?= $storeResult['store_num'] ?>&back=detail">フォロー中</a>
                    <? endif; ?>
                <?php endif; ?>
            </div>
            <nav class="store-nav">
                <ul class="store-nav__list">
                    <li class="store-nav__item">
                        <a class="store-nav__link" href="/user/store.php?id=<?= $id ?>">メニュー</a>
                    </li>
                    <li class="store-nav__item is-show">
                        <a class="store-nav__link" href="/user/store-detail.php?id=<?= $id ?>">店舗情報</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="store-info">
            <div class="store-info__item">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <?= $storeResult['store_tel'] ?>
            </div>
            <div class="store-info__item">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <?= $storeResult['store_post'] ?>&nbsp;<?= $storeResult['store_pref'].$storeResult['store_city'].$storeResult['store_add'] ?>
            </div>
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
</body>
</html>
