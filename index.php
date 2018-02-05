<?php
header('Content-Type:text/html; charset=UTF-8');
include('login_chk.php');
$pageTitle = 'フィード';
$searchValue = '';
$msg = '';
$copy = '';

if(isset($_POST['searchButton'])){
    $searchValue = $_POST['searchValue'];
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
    $sql = "select * from t_menu, t_store where t_menu.store_num = t_store.store_num and t_menu.menu_name like '%".$searchValue."%' order by t_menu.store_num";
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
        <div class="user-main-intro">
            <p class="user-main-intro__desc">
                注文はもっと簡単になる
            </p>
            <p class="user-main-intro__sub-desc">
                mepassならお気に入りの店舗はもちろん、初めて行く店舗でもスマートに注文が行えます。
                <a class="user-main-intro__link" href="">詳しく知る</a>
            </p>
            <form class="user-main-search" action="index.php" method="post">
                <input class="user-main-search__text" type="text" name="searchValue" value="<?= $searchValue ?>" placeholder="メニュー名検索" />
                <input class="user-main-search__submit" type="submit" name="searchButton" value="検索" />
            </form>
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
        <?php if($count != 0): ?>
        <ul class="user-main__menu">
        <?php for($i=0; $i<$count; $i++): ?>
            <?php if($copy != $rows[$i]['store_num']): ?>
            <li class="menu-card menu-card--4 store-card">
                <h3 class="user-main-ticket-top__title"><?= $rows[$i]['store_name'] ?>→</h3>
                <a class="store-card__button" href="">もっと見る</a>
            </li>
            <?php endif; ?>
            <li class="menu-card menu-card--4">
                <div class="menu-card__image-container">
                    <img src="/store/menu/images/<?= $rows[$i]['menu_file_name'] ?>" width="300">
                </div>
                <div class="menu-card__name"><?= $rows[$i]['menu_name'] ?></div>
                <div class="menu-card__price"><?= $rows[$i]['menu_price'] ?>円</div>
                <form class="menu-card-form" action="/user/ticket.php" method="post">
                    <input type="hidden" name="id" value="<?= $rows[$i]['menu_num'] ?>">
                    <input class="menu-card-form__number" type="number" name="num" value="1" min="1">点
                    <input class="menu-card-form__submit" type="submit" name="menuSelectSubmit" value="選択">
                </form>
            </li>
            <?php $copy = $rows[$i]['store_num']; ?>
        <?php endfor; ?>
        </ul>
        <?php else: ?>
            <p class="user-main-msg">メニューが見つかりませんでした。</p>
        <?php endif; ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
</html>
