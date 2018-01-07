<?php
include($_SERVER['DOCUMENT_ROOT']."/company/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "店舗情報管理";
$searchValue = "";

if(isset($_POST["btn"])){
    $searchValue = $_POST["userSearch"];
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

$SQL = "select * from t_store where store_name LIKE '%".$searchValue."%' and com_num = ".$comNum;
if(!$SqlRes = mysqli_query($Link,$SQL)){
    exit("MySQLクエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL);
}

while($Row = mysqli_fetch_array($SqlRes)){
    $RowAry[] = $Row;
}

$NumRow = mysqli_num_rows($SqlRes);

//  MySQLのメモリ解放(selectの時のみ)
mysqli_free_result($SqlRes);

if(!mysqli_close($Link)){
    exit("MySQL切断エラー");
}

?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <div id="wrapper">
        <?php include($_SERVER['DOCUMENT_ROOT']."/company/common.php"); ?>
        <main class="admin_main">
            <div class="admin_main_top">
                <form action="index.php" method="post">
                    <input class="admin_main_top_search" type="text" name="userSearch" value="<?php print $searchValue; ?>" placeholder="店舗名検索" />
                    <input type="submit" name="btn" value="検索" />
                </form>
                <a href="/company/store/create/">新規店舗登録</a>
            </div>
            <?php if($NumRow != 0): ?>
            <table>
                <tr>
                    <th>店舗名</th><th>所在地</th>
                </tr>
                <?php for($i=0; $i<$NumRow; $i++): ?>
                <tr>
                    <td><?php print $RowAry[$i]["store_name"]; ?></td>
                    <td>〒<?php print $RowAry[$i]["store_post"]; ?>&nbsp;<?php print $RowAry[$i]["store_pref"].$RowAry[$i]["store_city"].$RowAry[$i]["store_add"]; ?></td>
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
