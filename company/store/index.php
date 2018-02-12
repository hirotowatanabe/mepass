<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = '店舗情報管理';
$searchValue = '';

if(isset($_POST["btn"])){
    $searchValue = $_POST["storeSearch"];
}
include($_SERVER['DOCUMENT_ROOT']."/mysqlenv.php");
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " select * from t_store ";
    $sql .= " where store_name LIKE '%".$searchValue."%' ";
    $sql .= " and com_id = '".$comId."' ";
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
    <?php include($_SERVER['DOCUMENT_ROOT']."/company/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/company/gnav.php"); ?>
        <main class="admin-main">
            <div class="admin-main-top">
                <form action="index.php" method="post">
                    <input class="admin-main-top-form__text" type="text" name="storeSearch" value="<?= $searchValue ?>" placeholder="店舗名検索" />
                    <input class="admin-main-top-form__submit" type="submit" name="btn" value="検索" />
                </form>
                <a class="admin-main-top__button" href="/company/store/create/">新規店舗登録</a>
            </div>
            <?php if($count != 0): ?>
            <table>
                <tr>
                    <th>店舗名</th><th>所在地</th>
                </tr>
                <?php for($i=0; $i<$count; $i++): ?>
                <tr>
                    <td><a href="/company/store/detail.php?id=<?= $rows[$i]['store_num'] ?>"><?= $rows[$i]['store_name'] ?></a></td>
                    <td>〒<?= $rows[$i]['store_post'] ?>&nbsp;<?= $rows[$i]['store_pref'].$rows[$i]['store_city'].$rows[$i]['store_add'] ?></td>
                </tr>
                <?php endfor; ?>
            </table>
            <?php else: ?>
                <p>該当店舗は存在しません。</p>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
