<?php
include($_SERVER['DOCUMENT_ROOT']."/company/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "店舗情報管理／新規店舗登録／内容入力";
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/company/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/company/gnav.php"); ?>
        <main class="admin-main">
            <form action="/company/store/create/chk.php" method="post">
                <section class="application_main_form_section">
                    <h2 class="application_main_form_section_ttl">店舗名</h2>
                    <p class="application_main_form_section_item">
                        <h3 class="application_main_form_section_item_ttl">正式名称</h3>
                        <input type="text" name="storeName" value="">
                    </p>
                </section>
                <section class="application_main_form_section">
                    <h2 class="application_main_form_section_ttl">所在地</h2>
                    <p class="application_main_form_section_item">
                        <h3 class="application_main_form_section_item_ttl">郵便番号</h3>
                        <input type="text" name="storePost" value="">
                    </p>
                    <p class="application_main_form_section_item">
                        <h3 class="application_main_form_section_item_ttl">都道府県</h3>
                        <input type="text" name="storePref" value="">
                    </p>
                    <p class="application_main_form_section_item">
                        <h3 class="application_main_form_section_item_ttl">市区町村</h3>
                        <input type="text" name="storeCity" value="">
                    </p>
                    <p class="application_main_form_section_item">
                        <h3 class="application_main_form_section_item_ttl">番地以降</h3>
                        <input type="text" name="storeAdd" value="">
                    </p>
                </section>
                <section class="application_main_form_section">
                    <h2 class="application_main_form_section_ttl">お問い合わせ先</h2>
                    <p class="application_main_form_section_item">
                        <h3 class="application_main_form_section_item_ttl">電話番号</h3>
                        <input type="text" name="storeTel" value="">
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
