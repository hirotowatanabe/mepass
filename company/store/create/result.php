<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = '店舗情報管理／新規店舗登録／登録完了';
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/company/header.php'); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/company/gnav.php'); ?>
        <main class="admin-main">
            <p class="application-main-form__title">新規店舗登録が完了しました。</p>
            <a class="application-main-form__button" href="/company/store">店舗情報管理トップ</a>
        </main>
    </div>
</body>
</html>
