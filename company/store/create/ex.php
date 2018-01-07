<?php
include($_SERVER['DOCUMENT_ROOT']."/company/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "店舗情報管理／新規店舗登録／登録完了";

include($_SERVER['DOCUMENT_ROOT']."mysqlenv.php");

if(!$Link = mysqli_connect($HOST,$USER,$PASS)){
    exit("MySQL接続エラー<br />" . mysqli_connect_error());
}

$SQL = "set names utf8";
if(!mysqli_query($Link,$SQL)){
    exit("MySQL（文字コード設定）クエリー送信エラー<br />" . $SQL);
}

if(!mysqli_select_db($Link,$DB)){
    exit("MySQLデータベース選択エラー<br />" . $DB);
}

$SQL = "insert into t_store";
$SQL .= "(store_name, store_post, store_pref, store_city, store_add, store_tel, com_num)";
$SQL .= " values";
$SQL .= "('".$_SESSION["storeCreate"]["storeName"]."', '".$_SESSION["storeCreate"]["storePost"]."', '".$_SESSION["storeCreate"]["storePref"]."', '".$_SESSION["storeCreate"]["storeCity"]."', '".$_SESSION["storeCreate"]["storeAdd"]."', '".$_SESSION["storeCreate"]["storeTel"]."', ".$comNum.")";
if(!$SqlRes = mysqli_query($Link,$SQL)){
    exit("MySQLクエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL);
}

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
            <p>新規店舗登録が完了しました。</p>
            <a href="/company/store">店舗情報管理トップへ</a>
        </main>
    </div>
</body>
</html>
