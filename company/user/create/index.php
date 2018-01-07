<?php
include($_SERVER['DOCUMENT_ROOT']."/company/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "ユーザ情報管理／新規ユーザ登録／内容入力";

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

$SQL = "select * from t_store where com_num = ".$comNum;
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
    <?php include($_SERVER['DOCUMENT_ROOT']."/company/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/company/gnav.php"); ?>
        <main class="admin-main">
            <form action="/company/user/create/chk.php" method="post">
                <section class="application_main_form_section">
                    <h2 class="application_main_form_section_ttl">ユーザ情報</h2>
                    <p class="application_main_form_section_item">
                        <h3 class="application_main_form_section_item_ttl">所属店舗</h3>
                        <select name="storeNum">
                        <?php for($i=0; $i<$NumRow; $i++): ?>
                            <option value="<?php print $RowAry[$i]["store_num"]; ?>"><?php print $RowAry[$i]["store_name"]; ?></option>
                        <?php endfor; ?>
                        </select>
                    </p>
                    <p class="application_main_form_section_item">
                        <h3 class="application_main_form_section_item_ttl">氏名(漢字)</h3>
                        <input type="text" name="comMemNameKanji" value="">
                    </p>
                    <p class="application_main_form_section_item">
                        <h3 class="application_main_form_section_item_ttl">氏名(フリガナ)</h3>
                        <input type="text" name="comMemNameFurigana" value="">
                    </p>
                    <p class="application_main_form_section_item">
                        <h3 class="application_main_form_section_item_ttl">パスワード</h3>
                        <input type="text" name="comMemPass" value="">
                    </p>
                </section>
                <p class="application_main_form_btn">
                    <input type="submit" name="btn" value="次へ">
                </p>
            </form>
        </main>
    </div>
</body>
</html>
