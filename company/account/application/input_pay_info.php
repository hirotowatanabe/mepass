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
    <main class="application_main">
        <form class="application_main_form" method="post" action="chk.php">
            <p class="application_main_form_des">お支払い情報を入力してください。</p>
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">クレジットカード情報</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">カード会社</h3>
                    <select name="PayBrand">
                        <option value="#">選択して下さい。</option>
                        <option value="0">JCB</option>
                        <option value="1">VISA</option>
                        <option value="2">Master Card</option>
                        <option value="3">American Express</option>
                    </select>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">カード番号</h3>
                    <input type="text" name="PayNum" value="">
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">有効期限</h3>
                    <input type="date" name="PayDate" value="">
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">名義人</h3>
                    <input type="text" name="PayName" value="">
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">お支払い方法</h3>
                    <select name="PayHow">
                        <option value="#">選択して下さい。</option>
                        <option value="0">一括</option>
                        <option value="1">分割</option>
                    </select>
                </p>
            </section>
            <p class="application_main_form_btn">
                <input type="submit" name="btn" value="次へ">
            </p>
            <p class="application_main_form_btn">
                <input type="submit" name="btn" value="戻る">
            </p>
        </form>
    </main>
</body>
</html>
