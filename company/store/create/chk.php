<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = '店舗情報管理／新規店舗登録／内容確認';

$storeName = $storePost = $storePref = $storeCity = $storeAdd = $storeTel = '';

$storeName = $_POST['storeName'];
$storePost = $_POST['storePost'];
$storePref = $_POST['storePref'];
$storeCity = $_POST['storeCity'];
$storeAdd = $_POST['storeAdd'];
$storeTel = $_POST['storeTel'];

$_SESSION['storeCreate']['storeName'] = $storeName;
$_SESSION['storeCreate']['storePost'] = $storePost;
$_SESSION['storeCreate']['storePref'] = $storePref;
$_SESSION['storeCreate']['storeCity'] = $storeCity;
$_SESSION['storeCreate']['storeAdd'] = $storeAdd;
$_SESSION['storeCreate']['storeTel'] = $storeTel;
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
<?php include($_SERVER['DOCUMENT_ROOT'].'/company/header.php'); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/company/gnav.php'); ?>
        <main class="admin-main">
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">店舗情報</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">店舗名</h3>
                    <span class="application-main-disp__value"><?= $_SESSION['storeCreate']['storeName'] ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">所在地</h3>
                    <span class="application-main-disp__value">〒<?= $_SESSION['storeCreate']['storePost'] ?><br>
                    <?= $_SESSION['storeCreate']['storePref'].$_SESSION['storeCreate']['storeCity'].$_SESSION['storeCreate']['storeAdd'] ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">お問い合わせ先電話番号</h3>
                    <span class="application-main-disp__value"><?= $_SESSION['storeCreate']['storeTel'] ?></span>
                </div>
            </section>
            <a class="application-main-form__button" href="/company/store/create/ex.php">確定</a>
            <a class="application-main-form__button" href="/company/store/create/">戻る</a>
        </main>
    </div>
</body>
</html>
