<?php
include($_SERVER['DOCUMENT_ROOT']."/store/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "メニュー管理";
$name = "";
$price = "";
//ファイル一時退避ディレクトリ
$tmpDir = "../tmp/";
//ファイル名
$setFileName = $comMemNum."_".date("YmdHis");
if(isset($_POST["btn"])){
    $name = $_POST["name"];
    $price = $_POST["price"];
    //ファイルデータ取得
    $upFileName = $_FILES["fileData"]["name"];
    //トリミング情報取得
    $outputX = $_POST['fileDataX'];
    $outputY = $_POST['fileDataY'];
    $outputWidth = $_POST['fileDataW'];
    $outputHeight = $_POST['fileDataH'];
    //ファイル拡張子抽出
    $fileEx = substr($upFileName, strrpos($upFileName, "."));
    //ファイルコピー
    move_uploaded_file($_FILES["fileData"]["tmp_name"], $tmpDir.$setFileName.$fileEx);
    $_SESSION["createMenu"]["name"] = $name;
    $_SESSION["createMenu"]["price"] = $price;
    $_SESSION["createMenu"]["tmpDir"] = $tmpDir;
    $_SESSION["createMenu"]["fileNextName"] = $setFileName.$fileEx;

    //サムネイル生成
    //処理対象取得
    $imgInput = imagecreatefromjpeg($tmpDir.$setFileName.$fileEx);
    //元画像の横幅取得
    $inputWidth = imagesx($imgInput);
    //元画像の高さ取得
    $inputHeight = imagesy($imgInput);
    //サムネイル画像
    $imgSum = imagecreatetruecolor($outputWidth, $outputHeight);
    //再サンプル画像作成
    imagecopyresampled($imgSum, $imgInput, 0, 0, $outputX, $outputY, $outputWidth, $outputHeight, $outputWidth, $outputHeight);
    //サムネイル画像保存
    imagejpeg($imgSum, $tmpDir.$setFileName.$fileEx, 100);
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/store/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/store/gnav.php"); ?>
        <main class="admin-main">
            <h3 class="admin-main__title">新規メニュー登録／内容確認</h3>
            <section class="admin-main-disp__section">
                <div class="admin-main-disp__item">
                    <h3 class="admin-main-disp__title">メニュー名</h3>
                    <span class="admin-main-disp__value"><?= $name ?></span>
                </div>
                <div class="admin-main-disp__item">
                    <h3 class="admin-main-disp__title">価格</h3>
                    <span class="admin-main-disp__value"><?= $price ?>円</span>
                </div>
                <div class="admin-main-disp__item">
                    <h3 class="admin-main-disp__title">画像</h3>
                    <img src="<?= $tmpDir.$setFileName.$fileEx ?>" width="500" />
                </div>
            </section>
            <a class="admin-main-disp__button" href="/store/menu/create/ex.php">登録確定</a>
        </main>
    </div>
</body>
</html>
