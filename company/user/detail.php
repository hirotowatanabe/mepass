<?php
include($_SERVER['DOCUMENT_ROOT']."/company/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "ユーザ情報管理／詳細";
$comMemNum = "";

if(isset($_GET["num"])){
    $comMemNum = $_GET["num"];
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

$SQL = "select * from t_company_member where com_mem_num = ".$comMemNum;
if(!$SqlRes = mysqli_query($Link,$SQL)){
    exit("MySQLクエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL);
}

$Row = mysqli_fetch_array($SqlRes);

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
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">ユーザ情報</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">管理者番号</h3>
                    <?php print $Row["com_mem_num"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">所属店舗</h3>
                    <?php //print $Row["store_name"]; ?>名駅店
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">氏名(漢字)</h3>
                    <?php print $Row["com_mem_name_kanji"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">氏名(フリガナ)</h3>
                    <?php print $Row["com_mem_name_furigana"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">パスワード</h3>
                    ※個人情報保護の為、表示しておりません。
                </p>
            </section>
            <a href="/company/user/update/?num=<?php print $Row["com_mem_num"]; ?>">ユーザ情報変更</a>
            <a href="/company/user/delete/?num=<?php print $Row["com_mem_num"]; ?>">ユーザ情報削除</a>
        </main>
    </div>
</body>
</html>
