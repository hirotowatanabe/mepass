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
if($_SESSION["application"]["PlanNum"] == "0"){
    $DispPlanNum = "個人経営プラン";
}else if($_SESSION["application"]["PlanNum"] == "1"){
    $DispPlanNum = "小規模チェーンプラン";
}else if($_SESSION["application"]["PlanNum"] == "2"){
    $DispPlanNum = "中規模チェーンプラン";
}else if($_SESSION["application"]["PlanNum"] == "3"){
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
    <main class="application_main">
        <div class="application_main_form">
            <p class="application_main_form_des">お申込み内容をご確認ください。</p>
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">プラン選択情報</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">プラン名</h3>
                    <?php print $DispPlanNum; ?>
                </p>
            </section>
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">企業情報</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">企業名</h3>
                    <?php print $_SESSION["application"]["ComName"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">代表者氏名</h3>
                    <?php print $_SESSION["application"]["ComNameKanji"]; ?>（漢字）<br>
                    <?php print $_SESSION["application"]["ComNameFurigana"]; ?>（フリガナ）
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">所在地</h3>
                    〒<?php print $_SESSION["application"]["ComPost"]; ?><br>
                    <?php print $_SESSION["application"]["ComPref"].$_SESSION["application"]["ComCity"].$_SESSION["application"]["ComAdd"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">電話番号</h3>
                    <?php print $_SESSION["application"]["ComTel"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">メールアドレス</h3>
                    <?php print $_SESSION["application"]["ComMail"]; ?>
                </p>
            </section>
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">お支払い情報</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">カード会社</h3>
                    <?php print $DispPayBrand; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">カード番号</h3>
                    <?php print $_SESSION["application"]["PayNum"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">有効期限</h3>
                    <?php print $_SESSION["application"]["PayDate"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">名義人</h3>
                    <?php print $_SESSION["application"]["PayName"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">お支払い方法</h3>
                    <?php print $DispPayHow; ?>
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
        </div>
    </main>
</body>
</html>
