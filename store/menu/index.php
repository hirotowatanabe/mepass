<?php
include($_SERVER['DOCUMENT_ROOT']."/store/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "メニュー管理";
$searchValue = "";

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
    <?php include($_SERVER['DOCUMENT_ROOT']."/store/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/store/gnav.php"); ?>
        <main class="admin-main">
            <div class="admin-main-top">
                <form action="index.php" method="post">
                    <input class="admin-main-top-form__text" type="text" name="searchValue" value="<?= $searchValue ?>" placeholder="メニュー名検索" />
                    <input class="admin-main-top-form__submit" type="submit" name="searchButton" value="検索" />
                </form>
                <a class="admin-main-top__button" href="/store/menu/create/">新規メニュー登録</a>
            </div>
            <h3 class="admin-main__title">メニュー一覧</h3>
            <div class="admin-main__menu">
            <?php if($count != 0): ?>
                <?php for($i=0; $i<$count; $i++): ?>
                    <div class="menu-card menu-card--3">
                        <div class="menu-card__image-container">
                            <img src="images/<?= $rows[$i]["menu_file_name"] ?>" width="300">
                        </div>
                        <div class="menu-card__name"><?= $rows[$i]["menu_name"] ?></div>
                        <div class="menu-card__price"><?= $rows[$i]["menu_price"] ?>円</div>
                    </div>
                <?php endfor; ?>
            <?php else: ?>
                <p>登録されているメニューはありません。</p>
            <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
