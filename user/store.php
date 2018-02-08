<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = '店舗';
$id = '';
$msg = '';

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
    $sql = " select * from t_menu ";
    $sql .= " where store_num = ".$id;
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
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main">
        <div class="user-main-ticket-top">
            <h3 class="user-main-ticket-top__title"><?= $storeResult['store_name'] ?></h3>
            <div class="user-main-ticket-top__total">電話番号：<?= $storeResult['store_tel'] ?></div>
            <div class="user-main-ticket-top__total">住所：〒<?= $storeResult['store_post'] ?>&nbsp;<?= $storeResult['store_pref'].$storeResult['store_city'].$storeResult['store_add'] ?></div>
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
        <?php if($count != 0): ?>
        <ul class="user-main__menu">
        <?php for($i=0; $i<$count; $i++): ?>
            <li class="menu-card">
                <img class="menu-card__image" src="/store/menu/images/<?= $rows[$i]['menu_file_name'] ?>">
                <div class="menu-card__name"><?= $rows[$i]['menu_name'] ?></div>
                <div class="menu-card__price"><?= $rows[$i]['menu_price'] ?>円</div>
                <form class="menu-card-form" action="/user/ticket.php" method="post">
                    <input type="hidden" name="id" value="<?= $rows[$i]['menu_num'] ?>">
                    <input type="hidden" name="back" value="store">
                    <input type="hidden" name="storeId" value="<?= $storeResult['store_num'] ?>">
                    <input class="menu-card-form__number" type="number" name="num" value="1" min="1">点
                    <input class="menu-card-form__submit" type="submit" name="menuSelectSubmit" value="選択">
                </form>
            </li>
        <?php endfor; ?>
        </ul>
        <?php else: ?>
            <p class="user-main-msg">メニューが見つかりませんでした。</p>
        <?php endif; ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
</html>
