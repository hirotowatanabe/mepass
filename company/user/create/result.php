<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = 'ユーザ情報管理／新規ユーザ登録／登録完了';
$comMemNum = $_GET['comMemNum'];
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/company/header.php'); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/company/gnav.php'); ?>
        <main class="admin-main">
            <p class="application-main-form__title">新規ユーザ登録が完了しました。</p>
            <section class="application-main-form__section">
                <h2 class="application-main-form__sub-title">新規ユーザ店舗業務管理ログイン情報</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">管理者番号</h3>
                    <span class="application-main-disp__value"><?= sprintf('%08d', $comMemNum) ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">パスワード</h3>
                    <span class="application-main-disp__value">ご登録いただいたパスワード</span>
                </div>
            </section>
            <a class="application-main-form__button" href="/company/user/">ユーザ情報管理トップ</a>
        </main>
    </div>
</body>
</html>
