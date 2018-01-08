<?php
session_start();
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "企業情報入力 | 加盟店契約お申込み";
$planNum = "";

//企業情報変数宣言
$ComName = "";
$ComNameKanji = "";
$ComNameFurigana = "";
$ComPost = "";
$ComPref = "";
$ComCity = "";
$ComAdd = "";
$ComTel = "";
$ComMail = "";
$ComPass = "";

//企業情報取得
if(isset($_SESSION["application"]["ComName"])){
    $ComName = $_SESSION["application"]["ComName"];
    $ComNameKanji = $_SESSION["application"]["ComNameKanji"];
    $ComNameFurigana = $_SESSION["application"]["ComNameFurigana"];
    $ComPost = $_SESSION["application"]["ComPost"];
    $ComPref = $_SESSION["application"]["ComPref"];
    $ComCity = $_SESSION["application"]["ComCity"];
    $ComAdd = $_SESSION["application"]["ComAdd"];
    $ComTel = $_SESSION["application"]["ComTel"];
    $ComMail = $_SESSION["application"]["ComMail"];
    $ComPass = $_SESSION["application"]["ComPass"];
}

if(isset($_POST["planNum"])){
    $planNum = $_POST["planNum"];
    $_SESSION["application"]["planNum"] = $planNum;
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body class="application">
<?php include($_SERVER['DOCUMENT_ROOT']."/company/account/application/header.php"); ?>
    <main class="application-main">
        <form class="application-main-form" method="post" action="input_pay_info.php">
            <p class="application-main-form__description">企業情報入力を入力してください。</p>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">企業名</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">正式名称</h3>
                    <input class="application-main-form__text" type="text" name="ComName" value="<?php print $ComName; ?>">
                </div>
            </section>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">代表者氏名</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">漢字</h3>
                    <input class="application-main-form__text" type="text" name="ComNameKanji" value="<?php print $ComNameKanji; ?>">
                </div>
                <div class="application_main_form__item">
                    <h3 class="application-main-form__sub-title">フリガナ</h3>
                    <input class="application-main-form__text" type="text" name="ComNameFurigana" value="<?php print $ComNameFurigana; ?>">
                </div>
            </section>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">所在地</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">郵便番号</h3>
                    <input class="application-main-form__text" type="text" name="ComPost" value="<?php print $ComPost; ?>">
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">都道府県</h3>
                    <input class="application-main-form__text" type="text" name="ComPref" value="<?php print $ComPref; ?>">
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">市区町村</h3>
                    <input class="application-main-form__text" type="text" name="ComCity" value="<?php print $ComCity; ?>">
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">番地以降</h3>
                    <input class="application-main-form__text" type="text" name="ComAdd" value="<?php print $ComAdd; ?>">
                </div>
            </section>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">連絡先</h2>
                <p class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">電話番号</h3>
                    <input class="application-main-form__text" type="text" name="ComTel" value="<?php print $ComTel; ?>">
                </p>
                <p class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">メールアドレス</h3>
                    <input class="application-main-form__text" type="email" name="ComMail" value="<?php print $ComMail; ?>">
                </p>
            </section>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">企業ページアクセス情報</h2>
                <p class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">パスワード</h3>
                    <input class="application-main-form__text" type="password" name="ComPass" value="<?php print $ComPass; ?>">
                </p>
            </section>
            <input class="application-main-form__submit" type="submit" name="next" value="次へ">
            <input class="application-main-form__submit application-main-form__submit--go-select_plan" type="submit" name="btn" value="戻る">
        </form>
    </main>
</body>
</html>
