<?php
include($_SERVER['DOCUMENT_ROOT']."/company/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "ユーザ情報管理／新規ユーザ登録／登録完了";

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

$SQL = "insert into t_company_member";
$SQL .= "(com_mem_pass, com_mem_name_kanji, com_mem_name_furigana, com_mem_auth, com_num, store_num)";
$SQL .= " values";
$SQL .= "('".$_SESSION["comMemCreate"]["comMemPass"]."', '".$_SESSION["comMemCreate"]["comMemNameKanji"]."', '".$_SESSION["comMemCreate"]["comMemNameFurigana"]."', '0', ".$comNum.", ".$_SESSION["comMemCreate"]["storeNum"].")";
if(!$SqlRes = mysqli_query($Link,$SQL)){
    exit("MySQLクエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL);
}

//自動採番値取得
$SQL2 = "select last_insert_id() as com_mem_num";
if(!$SqlRes = mysqli_query($Link,$SQL2)){
    exit("MySQLクエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL2);
}

//  連想配列への抜出（先頭行）
$Row2 = mysqli_fetch_array($SqlRes);

//  抜き出されたレコード件数を求める
$NumRow2 = mysqli_num_rows($SqlRes);

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
            <p class="application_main_form_des">新規ユーザ登録が完了しました。</p>
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">新規ユーザ店舗業務管理ログイン情報</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">管理者番号</h3>
                    <?php print sprintf("%08d", $Row2["com_mem_num"]); ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">パスワード</h3>
                    ご登録いただいたパスワード
                </p>
            </section>
            <a href="/company/user/">ユーザ情報管理トップへ</a>
        </main>
    </div>
</body>
</html>
