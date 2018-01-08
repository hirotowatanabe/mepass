<?php
include($_SERVER['DOCUMENT_ROOT']."/store/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "メニュー管理";
//ステータス設定(公開)
$status = "1";
//ファイル一時退避ディレクトリ
$tmpDir = $_SESSION["createMenu"]["tmpDir"];
//ファイル移動先ディレクトリ
$imagesDir = "../images/";
//ファイル名
$fileName = $_SESSION["createMenu"]["fileNextName"];
$name = $_SESSION["createMenu"]["name"];
$price = $_SESSION["createMenu"]["price"];
//ファイル移動
if(!rename($tmpDir.$fileName, $imagesDir.$fileName)){
    print "ファイルの移動に失敗しました。";
}

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

$SQL = "insert into t_menu";
$SQL .= "(menu_name, menu_price, menu_file_name, menu_status, store_num)";
$SQL .= " values";
$SQL .= "('".$name."', ".$price.", '".$fileName."', '".$status."', ".$storeNum.")";
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
    <?php include($_SERVER['DOCUMENT_ROOT']."/store/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/store/gnav.php"); ?>
        <main class="admin-main">
            <h3 class="admin-main-disp__title">新規メニュー登録が完了しました。</h3>
            <div class="admin-main-disp__item">
                <a class="admin-main-disp__button" href="/store/menu/create">続けて登録する</a>
            </div>
            <div class="admin-main-disp__item">
                <a class="admin-main-disp__button" href="/store/menu/">メニュー管理トップへ</a>
            </div>
        </main>
    </div>
</body>
</html>
