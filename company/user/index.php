<?php
include($_SERVER['DOCUMENT_ROOT']."/company/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "ユーザ情報管理";
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

$SQL = "select * from t_company_member, t_store where com_mem_name_kanji LIKE '%".$searchValue."%' and t_company_member.com_num = ".$comNum." and t_company_member.store_num = t_store.store_num";
if(!$SqlRes = mysqli_query($Link,$SQL)){
    exit("MySQLクエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL);
}

while($Row = mysqli_fetch_array($SqlRes)){
    $RowAry[] = $Row;
}

//  抜き出されたレコード件数を求める
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
    <?php include($_SERVER['DOCUMENT_ROOT']."/company/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/company/gnav.php"); ?>
        <main class="admin-main">
            <div class="admin-main_top">
                <form action="index.php" method="post">
                    <input class="admin-main_top_search" type="text" name="userSearch" value="<?php print $searchValue; ?>" placeholder="ユーザ名検索" />
                    <input class="admin-main_top_submit" type="submit" name="btn" value="検索" />
                </form>
                <a class="anchor_btn" href="/company/user/create/">新規ユーザ登録</a>
            </div>
            <?php if($NumRow != 0): ?>
            <table>
                <tr>
                    <th>ユーザ名</th><th>所属店舗</th>
                </tr>
                <?php for($i=0; $i<$NumRow; $i++): ?>
                <tr>
                    <td><a href="/company/user/detail.php?num=<?php print $RowAry[$i]["com_mem_num"]; ?>"><?php print $RowAry[$i]["com_mem_name_kanji"]; ?></a></td><td><?php print $RowAry[$i]["store_name"] ?></td>
                </tr>
                <?php endfor; ?>
            </table>
            <?php else: ?>
                <p>該当ユーザは存在しません。</p>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
