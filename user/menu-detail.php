<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = 'メニュー詳細';
$menuId = $msg = '';

if(isset($_GET['menuId'])){
    $menuId = $_GET['menuId'];
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
    $sql = " select * from t_menu, t_store ";
    $sql .= " where t_menu.menu_num = ".$menuId;
    $sql .= " and t_menu.store_num = t_store.store_num ";
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
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>
    <main class="user-main">
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
        <?php if($count != 0): ?>
        <div class="menu-detail-breadcrumbs">
            <a class="menu-detail-breadcrumbs__link" href="/user/store.php?id=<?= $result['store_num'] ?>"><?= $result['store_name'] ?></a>&nbsp;&gt;&nbsp;メニュー詳細
        </div>
        <div class="menu-detail">
            <div class="menu-detail__left-container">
                <img class="menu-detail__image" src="/store/menu/images/<?= $result['menu_file_name'] ?>">
            </div>
            <div class="menu-detail__right-container">
                <div class="menu-detail__name"><?= $result['menu_name'] ?></div>
                <div class="menu-detail__price"><?= $result['menu_price'] ?>円</div>
                <form action="/user/ticket.php" method="post">
                    <input type="hidden" name="id" value="<?= $result['menu_num'] ?>">
                    <input type="hidden" name="back" value="detail">
                    <input type="hidden" name="storeId" value="<?= $result['store_num'] ?>">
                    <p class="menu-detail__number">
                        <input class="menu-detail__input" type="number" name="num" value="1" min="1">
                        <span class="menu-detail__unit">点</span>
                    </p>
                    <input class="menu-detail__submit" type="submit" name="menuSelectSubmit" value="チケットを選択">
                </form>
            </div>
        </div>
        <?php else: ?>
            <p class="user-main-msg">メニューが見つかりませんでした。</p>
        <?php endif; ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
</body>
</html>
