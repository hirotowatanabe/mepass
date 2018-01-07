<?php
include($_SERVER['DOCUMENT_ROOT']."/company/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "ユーザ情報管理／ユーザ情報変更／内容確認";

$comMemNameKanji = "";
$comMemNameFurigana = "";
$comMemPass = "";
$storeNum = "";

$comMemNameKanji = $_POST["comMemNameKanji"];
$comMemNameFurigana = $_POST["comMemNameFurigana"];
$comMemPass = $_POST["comMemPass"];
$storeNum = $_POST["storeNum"];

$_SESSION["comMemCreate"]["comMemNameKanji"] = $comMemNameKanji;
$_SESSION["comMemCreate"]["comMemNameFurigana"] = $comMemNameFurigana;
$_SESSION["comMemCreate"]["comMemPass"] = $comMemPass;
$_SESSION["comMemCreate"]["storeNum"] = $storeNum;

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

$SQL = "select * from t_store where store_num = ".$_SESSION["comMemCreate"]["storeNum"];
if(!$SqlRes = mysqli_query($Link,$SQL)){
    exit("MySQLクエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL);
}

$Row = mysqli_fetch_array($SqlRes);

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
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">ユーザ情報</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">所属店舗</h3>
                    <?php print $Row["store_name"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">氏名(漢字)</h3>
                    <?php print $_SESSION["comMemCreate"]["comMemNameKanji"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">氏名(フリガナ)</h3>
                    <?php print $_SESSION["comMemCreate"]["comMemNameFurigana"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">パスワード</h3>
                    ※個人情報保護の為、表示しておりません。
                </p>
            </section>
            <form method="post" action="ex.php">
                <p class="application_main_form_btn">
                    <input type="submit" name="btn" value="次へ">
                </p>
                <p class="application_main_form_btn">
                    <input type="submit" name="btn" value="戻る">
                </p>
            </form>
        </main>
    </div>
</body>
</html>
