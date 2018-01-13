<?php
header('Content-Type:text/html; charset=UTF-8');
include('login_chk.php');
$pageTitle = 'フィード';
$searchValue = '';

if(isset($_POST['searchButton'])){
    $searchValue = $_POST['searchValue'];
}

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = "select * from t_menu where menu_name like '%".$searchValue."%'";
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
        <form class="user-main__search" action="index.php" method="post">
            <input class="admin-main-top-form__text" type="text" name="searchValue" value="<?= $searchValue ?>" placeholder="メニュー名検索" />
            <input class="admin-main-top-form__submit" type="submit" name="searchButton" value="検索" />
        </form>
        <div class="admin-main__menu">
        <?php if($count != 0): ?>
            <?php for($i=0; $i<$count; $i++): ?>
                <div class="menu-card">
                    <img src="/store/menu/images/<?= $rows[$i]['menu_file_name'] ?>" width="300">
                    <div class="menu-card__name"><?= $rows[$i]['menu_name'] ?></div>
                    <div class="menu-card__price"><?= $rows[$i]['menu_price'] ?>円</div>
                    <form action="/user/ticket.php" method="post">
                        <input type="hidden" name="id" value="<?= $result[$i]['menu_num'] ?>">
                        <input class="menu-card-form__number" type="number" name="num" value="1">点
                        <input class="menu-card-form__submit" type="submit" name="menuSelectSubmit" value="選択">
                    </form>
                </div>
            <?php endfor; ?>
        <?php else: ?>
            <p>メニューが見つかりませんでした。</p>
        <?php endif; ?>
        </div>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
</html>
