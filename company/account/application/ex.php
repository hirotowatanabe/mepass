<?php
session_start();
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "お申込み完了 | 加盟店契約お申込み";

include($_SERVER['DOCUMENT_ROOT']."/mysqlenv.php");

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

//企業テーブルへ格納
$SQL1 = "insert into t_company";
$SQL1 .= "(plan_num, com_name, com_name_kanji, com_name_furigana, com_post, com_pref, com_city, com_add, com_tel, com_mail, com_pass)";
$SQL1 .= " values";
$SQL1 .= "('".$_SESSION["application"]["PlanNum"]."', '".$_SESSION["application"]["ComName"]."', '".$_SESSION["application"]["ComNameKanji"]."', '".$_SESSION["application"]["ComNameFurigana"]."', '".$_SESSION["application"]["ComPost"]."', '".$_SESSION["application"]["ComPref"]."', '".$_SESSION["application"]["ComCity"]."', '".$_SESSION["application"]["ComAdd"]."', '".$_SESSION["application"]["ComTel"]."', '".$_SESSION["application"]["ComMail"]."', '".$_SESSION["application"]["ComPass"]."')";
if(!$SqlRes = mysqli_query($Link,$SQL1)){
    exit("MySQL（企業テーブル格納）クエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL1);
}

//企業番号取得
$SQL2 = "select last_insert_id() as \"com_num\"";
if(!$SqlRes = mysqli_query($Link,$SQL2)){
    exit("MySQL（企業番号取得）クエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL2);
}

//  連想配列への抜出（先頭行）
$Row2 = mysqli_fetch_array($SqlRes);

//  抜き出されたレコード件数を求める
$NumRow2 = mysqli_num_rows($SqlRes);

//  MySQLのメモリ解放(selectの時のみ)
mysqli_free_result($SqlRes);

//企業用クレジットカードテーブルへ格納
$SQL3 = "insert into t_company_credit ";
$SQL3 .= "(com_credit_brand_num, com_credit_num, com_credit_date, com_credit_name, com_credit_how_num, com_num) ";
$SQL3 .= "values ";
$SQL3 .= "('".$_SESSION["application"]["PayBrand"]."', '".$_SESSION["application"]["PayNum"]."', '".$_SESSION["application"]["PayDate"]."', '".$_SESSION["application"]["PayName"]."', '".$_SESSION["application"]["PayHow"]."', ".$Row2["com_num"].")";
if(!$SqlRes = mysqli_query($Link,$SQL3)){
    exit("MySQL（企業用クレジットカードテーブル格納）クエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL3);
}

//  MySQLとの切断
if(!mysqli_close($Link)){
  exit("MySQL切断エラー");
}

if($NumRow2 == "0"){
    print "エラー：企業番号取得に失敗しました。";
}

$_SESSION["company"]["comNum"] = $Row2["com_num"];
$_SESSION["company"]["comName"] = $_SESSION["application"]["ComName"];
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body class="application">
    <?php include($_SERVER['DOCUMENT_ROOT']."/company/account/application/header.php"); ?>
    <main class="application_main">
        <div class="application_main_form">
            <p class="application_main_form_des">お申し込みが完了しました。<br>
            以下は企業ページへのログイン情報です。</p>
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">初期アカウント情報</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">企業番号</h3>
                    <?php print $Row2["com_num"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">パスワード</h3>
                    設定したパスワード
                </p>
            </section>
            <a href="/company/">企業ページへ進む</a>
        </div>
    </main>
</body>
</html>
