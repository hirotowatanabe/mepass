<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = '店舗情報管理／新規店舗登録／内容入力';

$storeName = $storePost = $storePref = $storeCity = $storeAdd = $storeTel = '';

if(isset($_SESSION['storeCreate'])){
    $storeName = $_SESSION['storeCreate']['storeName'];
    $storePost = $_SESSION['storeCreate']['storePost'];
    $storePref = $_SESSION['storeCreate']['storePref'];
    $storeCity = $_SESSION['storeCreate']['storeCity'];
    $storeAdd = $_SESSION['storeCreate']['storeAdd'];
    $storeTel = $_SESSION['storeCreate']['storeTel'];
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php') ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/company/header.php'); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/company/gnav.php'); ?>
        <main class="admin-main">
            <form action="/company/store/create/chk.php" method="post">
                <section class="application-main-form__section">
                    <h2 class="application-main-form__title">店舗名</h2>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">ユーザー画面でも同様に表示されます。</h3>
                        <input class="application-main-form__text" type="text" name="storeName" value="<?= $storeName ?>" required>
                    </div>
                </section>
                <section class="application-main-form__section">
                    <h2 class="application-main-form__title">所在地</h2>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">郵便番号（ハイフンを含む）</h3>
                        <input class="application-main-form__text" type="text" name="storePost" value="<?= $storePost ?>" required>
                    </div>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">都道府県</h3>
                        <input class="application-main-form__text" type="text" name="storePref" value="<?= $storePref ?>" required>
                    </div>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">市区町村</h3>
                        <input class="application-main-form__text" type="text" name="storeCity" value="<?= $storeCity ?>" required>
                    </div>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">番地以降</h3>
                        <input class="application-main-form__text" type="text" name="storeAdd" value="<?= $storeAdd ?>">
                    </div>
                </section>
                <section class="application-main-form__section">
                    <h2 class="application-main-form__title">お問い合わせ先</h2>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">電話番号（ハイフンは含まない）</h3>
                        <input class="application-main-form__text" type="text" name="storeTel" value="<?= $storeTel ?>" required>
                    </div>
                </section>
                <div class="application-main-form__item">
                    <input class="application-main-form__submit" type="submit" name="btn" value="次へ">
                </div>
            </form>
        </main>
    </div>
</body>
</html>
