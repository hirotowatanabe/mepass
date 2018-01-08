<?php
session_start();
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "お申込み内容確認 | 加盟店契約お申込み";
//変数宣言

//プラン選択情報（表示用）
$DispPlanNum = "";
//支払情報
$PayBrand = "";
$PayNum = "";
$PayDate = "";
$PayName = "";
$PayHow = "";

//支払情報（表示用）
$DispPayBrand = "";
$DispPayHow = "";

//データ受け取り

//プラン選択情報（表示用データ生成）
if($_SESSION["application"]["planNum"] == "0"){
    $DispPlanNum = "個人経営プラン";
}else if($_SESSION["application"]["planNum"] == "1"){
    $DispPlanNum = "小規模チェーンプラン";
}else if($_SESSION["application"]["planNum"] == "2"){
    $DispPlanNum = "中規模チェーンプラン";
}else if($_SESSION["application"]["planNum"] == "3"){
    $DispPlanNum = "大規模チェーンプラン";
}

//支払情報
$PayBrand = $_POST["PayBrand"];
$PayNum = $_POST["PayNum"];
$PayDate = $_POST["PayDate"];
$PayName = $_POST["PayName"];
$PayHow = $_POST["PayHow"];

//支払情報セッション格納
$_SESSION["application"]["PayBrand"] = $PayBrand;
$_SESSION["application"]["PayNum"] = $PayNum;
$_SESSION["application"]["PayDate"] = $PayDate;
$_SESSION["application"]["PayName"] = $PayName;
$_SESSION["application"]["PayHow"] = $PayHow;

//支払情報（表示用データ生成）
if($_SESSION["application"]["PayBrand"] == "0"){
    $DispPayBrand = "JCB";
}else if($_SESSION["application"]["PayBrand"] == "1"){
    $DispPayBrand = "VISA";
}else if($_SESSION["application"]["PayBrand"] == "2"){
    $DispPayBrand = "Master Card";
}else if($_SESSION["application"]["PayBrand"] == "3"){
    $DispPayBrand = "American Express";
}

//支払情報（表示用データ生成）
if($_SESSION["application"]["PayHow"] == "0"){
    $DispPayHow = "一括";
}else if($_SESSION["application"]["PayHow"] == "1"){
    $DispPayHow = "分割";
}

?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body class="application">
<?php include($_SERVER['DOCUMENT_ROOT']."/company/account/application/header.php"); ?>
    <main class="application-main">
        <div class="application-main-form">
            <p class="application-main-form__description">お申込み内容をご確認ください。</p>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">プラン選択情報</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">プラン名</h3>
                    <span class="application-main-disp__value"><?php print $DispPlanNum; ?></span>
                </div>
            </section>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">企業情報</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">企業名</h3>
                    <span class="application-main-disp__value"><?php print $_SESSION["application"]["ComName"]; ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">代表者氏名</h3>
                    <span class="application-main-disp__value"><?php print $_SESSION["application"]["ComNameKanji"]; ?>（漢字）<br>
                    <?php print $_SESSION["application"]["ComNameFurigana"]; ?>（フリガナ）</span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">所在地</h3>
                    <span class="application-main-disp__value">〒<?php print $_SESSION["application"]["ComPost"]; ?><br>
                    <?php print $_SESSION["application"]["ComPref"].$_SESSION["application"]["ComCity"].$_SESSION["application"]["ComAdd"]; ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main_form__sub-title">電話番号</h3>
                    <span class="application-main-disp__value"><?php print $_SESSION["application"]["ComTel"]; ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">メールアドレス</h3>
                    <span class="application-main-disp__value"><?php print $_SESSION["application"]["ComMail"]; ?></span>
                </div>
            </section>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">お支払い情報</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">カード会社</h3>
                    <span class="application-main-disp__value"><?php print $DispPayBrand; ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">カード番号</h3>
                    <span class="application-main-disp__value"><?php print $_SESSION["application"]["PayNum"]; ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">有効期限</h3>
                    <span class="application-main-disp__value"><?php print $_SESSION["application"]["PayDate"]; ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">名義人</h3>
                    <span class="application-main-disp__value"><?php print $_SESSION["application"]["PayName"]; ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">お支払い方法</h3>
                    <span class="application-main-disp__value"><?php print $DispPayHow; ?></span>
                </div>
            </section>
            <a class="application-main-form__button" href="ex.php">確定</a>
            <a class="application-main-form__button" href="input_pay_info.php">戻る</a>
        </div>
    </main>
</body>
</html>
