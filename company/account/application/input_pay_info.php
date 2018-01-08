<?php
session_start();
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "お支払い情報入力 | 加盟店契約お申込み";

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

//企業情報受け取り
if(isset($_POST["next"])){
    $ComName = $_POST["ComName"];
    $ComNameKanji = $_POST["ComNameKanji"];
    $ComNameFurigana = $_POST["ComNameFurigana"];
    $ComPost = $_POST["ComPost"];
    $ComPref = $_POST["ComPref"];
    $ComCity = $_POST["ComCity"];
    $ComAdd = $_POST["ComAdd"];
    $ComTel = $_POST["ComTel"];
    $ComMail = $_POST["ComMail"];
    $ComPass = $_POST["ComPass"];
}

//企業情報セッション格納
$_SESSION["application"]["ComName"] = $ComName;
$_SESSION["application"]["ComNameKanji"] = $ComNameKanji;
$_SESSION["application"]["ComNameFurigana"] = $ComNameFurigana;
$_SESSION["application"]["ComPost"] = $ComPost;
$_SESSION["application"]["ComPref"] = $ComPref;
$_SESSION["application"]["ComCity"] = $ComCity;
$_SESSION["application"]["ComAdd"] = $ComAdd;
$_SESSION["application"]["ComTel"] = $ComTel;
$_SESSION["application"]["ComMail"] = $ComMail;
$_SESSION["application"]["ComPass"] = $ComPass;

?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body class="application">
<?php include($_SERVER['DOCUMENT_ROOT']."/company/account/application/header.php"); ?>
    <main class="application-main">
        <form class="application-main-form" method="post" action="chk.php">
            <p class="application-main-form__description">お支払い情報を入力してください。</p>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">クレジットカード情報</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">カード会社</h3>
                    <select class="application-main-form__text" name="PayBrand">
                        <option value="#">選択して下さい。</option>
                        <option value="0">JCB</option>
                        <option value="1">VISA</option>
                        <option value="2">Master Card</option>
                        <option value="3">American Express</option>
                    </select>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">カード番号</h3>
                    <input class="application-main-form__text" type="text" name="PayNum" value="">
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">有効期限</h3>
                    <input class="application-main-form__text" type="month" name="PayDate" value="">
                </div>
                <p class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">名義人</h3>
                    <input class="application-main-form__text" type="text" name="PayName" value="">
                </p>
                <p class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">お支払い方法</h3>
                    <select class="application-main-form__text" name="PayHow">
                        <option value="#">選択して下さい。</option>
                        <option value="0">一括</option>
                        <option value="1">分割</option>
                    </select>
                </p>
            </section>
            <input class="application-main-form__submit" type="submit" name="next" value="次へ">
            <input class="application-main-form__submit application-main-form__submit--go-input_com_info" type="submit" name="back" value="戻る">
        </form>
    </main>
</body>
</html>
