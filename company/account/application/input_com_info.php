<?php
session_start();
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "企業情報入力 | 加盟店契約お申込み";
$PlanNum = "";

if(isset($_POST["PlanNum"])){
    $PlanNum = $_POST["PlanNum"];
    $_SESSION["application"]["PlanNum"] = $PlanNum;
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body class="application">
<?php include($_SERVER['DOCUMENT_ROOT']."/company/account/application/header.php"); ?>
    <main class="application_main">
        <form class="application_main_form" method="post" action="input_pay_info.php">
            <p class="application_main_form_des">企業情報入力を入力してください。</p>
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">企業名</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">正式名称</h3>
                    <input type="text" name="ComName" value="">
                </p>
            </section>
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">代表者氏名</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">漢字</h3>
                    <input type="text" name="ComNameKanji" value="">
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">フリガナ</h3>
                    <input type="text" name="ComNameFurigana" value="">
                </p>
            </section>
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">所在地</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">郵便番号</h3>
                    <input type="text" name="ComPost" value="">
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">都道府県</h3>
                    <input type="text" name="ComPref" value="">
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">市区町村</h3>
                    <input type="text" name="ComCity" value="">
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">番地以降</h3>
                    <input type="text" name="ComAdd" value="">
                </p>
            </section>
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">連絡先</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">電話番号</h3>
                    <input type="text" name="ComTel" value="">
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">メールアドレス</h3>
                    <input type="email" name="ComMail" value="">
                </p>
            </section>
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">企業ページアクセス情報</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">パスワード</h3>
                    <input type="text" name="ComPass" value="">
                </p>
            </section>
                <p class="application_main_form_btn">
                    <input type="submit" name="btn" value="次へ">
                </p>
                <p class="application_main_form_btn">
                    <input type="button" name="btn" value="戻る">
                </p>
        </form>
    </main>
</body>
</html>
