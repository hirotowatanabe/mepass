<?php
header("Content-Type:text/html; charset=UTF-8");
include("login_chk.php");
$pageTitle = "フィード";
$searchValue = "";

if(isset($_POST["searchButton"])){
    $searchValue = $_POST["searchValue"];
}

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

$SQL = "select * from t_menu where menu_name like '%".$searchValue."%'";
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
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main">
        <form class="user-main__search" action="index.php" method="post">
            <input class="admin-main-top-form__text" type="text" name="searchValue" value="<?php print $searchValue; ?>" placeholder="メニュー名検索" />
            <input class="admin-main-top-form__submit" type="submit" name="searchButton" value="検索" />
        </form>
        <div class="admin-main__menu">
        <?php if($NumRow != 0): ?>
            <?php for($i=0; $i<$NumRow; $i++): ?>
                <div class="menu-card">
                    <img src="/store/menu/images/<?php print $RowAry[$i]["menu_file_name"]; ?>" width="300">
                    <div class="menu-card__name"><?php print $RowAry[$i]["menu_name"]; ?></div>
                    <div class="menu-card__price"><?php print $RowAry[$i]["menu_price"]; ?>円</div>
                    <form action="/user/ticket.php" method="post">
                        <input type="hidden" name="id" value="<?php print $RowAry[$i]["menu_num"]; ?>">
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
