<?php
include($_SERVER['DOCUMENT_ROOT']."/company/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "ユーザ情報管理／ユーザ情報／更新完了";

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

$SQL = "update t_company_member";
$SQL .= " set ";
$SQL .= "com_mem_pass = '".$_SESSION["comMemCreate"]["comMemPass"]."',";
$SQL .= "com_mem_name_kanji = '".$_SESSION["comMemCreate"]["comMemNameKanji"]."',";
$SQL .= "com_mem_name_furigana = '".$_SESSION["comMemCreate"]["comMemNameFurigana"]."',";
$SQL .= "store_num = ".$_SESSION["comMemCreate"]["storeNum"];
$SQL .= " where ";
$SQL .= "com_mem_num = ".$_SESSION["comMemCreate"]["comMemNum"];

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
            <p class="application_main_form_des">ユーザ情報更新が完了しました。</p>
            <a href="/company/user/">ユーザ情報管理トップへ</a>
        </main>
    </div>
</body>
</html>
