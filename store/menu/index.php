<?php
include($_SERVER['DOCUMENT_ROOT']."/store/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "メニュー管理";
$searchValue = "";

include($_SERVER['DOCUMENT_ROOT']."/mysqlenv.php");

if(!$Link = mysqli_connect($HOST,$USER,$PASS)){
    exit("MySQL接続エラー<br />" . mysqli_connect_error());
}

$SQL = "set names utf8";
if(!mysqli_query($Link,$SQL)){
    exit("MySQLクエリー送信エラー<br />" . $SQL);
}

if(!mysqli_select_db($Link,$DB)){
    exit("MySQLデータベース選択エラー<br />" . $DB);
}

$SQL = "select * from t_menu";
if(!$SqlRes = mysqli_query($Link,$SQL)){
    exit("MySQLクエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL);
}

while($Row = mysqli_fetch_array($SqlRes)){
    $RowAry[] = $Row;
}

$NumRow = mysqli_num_rows($SqlRes);

mysqli_free_result($SqlRes);

if(!mysqli_close($Link)){
    exit("MySQL切断エラー");
}
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
                    <input class="admin-main-top-form__text" type="text" name="userSearch" value="<?php print $searchValue; ?>" placeholder="メニュー名検索" />
                    <input class="admin-main-top-form__submit" type="submit" name="btn" value="検索" />
                </form>
                <a class="admin-main-top__button" href="/store/menu/create/">新規メニュー登録</a>
            </div>
            <h3 class="admin-main__title">メニュー一覧</h3>
            <div class="admin-main__menu">
            <?php if($NumRow != 0): ?>
                <?php for($i=0; $i<$NumRow; $i++): ?>
                    <div class="menu-card">
                        <img src="images/<?php print $RowAry[$i]["menu_file_name"]; ?>" width="300">
                        <div class="menu-card__name"><?php print $RowAry[$i]["menu_name"]; ?></div>
                        <div class="menu-card__price"><?php print $RowAry[$i]["menu_price"]; ?>円</div>
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
