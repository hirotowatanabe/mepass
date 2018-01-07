<?php
include($_SERVER['DOCUMENT_ROOT']."/company/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "店舗情報管理／新規店舗登録／内容確認";

$storeName = "";
$storePost = "";
$storePref = "";
$storeCity = "";
$storeAdd = "";
$storeTel = "";

$storeName = $_POST["storeName"];
$storePost = $_POST["storePost"];
$storePref = $_POST["storePref"];
$storeCity = $_POST["storeCity"];
$storeAdd = $_POST["storeAdd"];
$storeTel = $_POST["storeTel"];

$_SESSION["storeCreate"]["storeName"] = $storeName;
$_SESSION["storeCreate"]["storePost"] = $storePost;
$_SESSION["storeCreate"]["storePref"] = $storePref;
$_SESSION["storeCreate"]["storeCity"] = $storeCity;
$_SESSION["storeCreate"]["storeAdd"] = $storeAdd;
$_SESSION["storeCreate"]["storeTel"] = $storeTel;
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
<?php include($_SERVER['DOCUMENT_ROOT']."/company/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/company/gnav.php"); ?>
        <main class="admin-main">
            <section class="application_main_form_section">
                <h2 class="application_main_form_section_ttl">店舗情報</h2>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">店舗名</h3>
                    <?php print $_SESSION["storeCreate"]["storeName"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">所在地</h3>
                    〒<?php print $_SESSION["storeCreate"]["storePost"]; ?><br>
                    <?php print $_SESSION["storeCreate"]["storePref"].$_SESSION["storeCreate"]["storeCity"].$_SESSION["storeCreate"]["storeAdd"]; ?>
                </p>
                <p class="application_main_form_section_item">
                    <h3 class="application_main_form_section_item_ttl">お問い合わせ先電話番号</h3>
                    <?php print $_SESSION["storeCreate"]["storeTel"]; ?>
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
        </main>
    </div>
</body>
</html>
