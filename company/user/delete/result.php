<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = 'ユーザ情報管理／ユーザ情報削除／削除完了';
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/company/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/company/gnav.php"); ?>
        <main class="admin-main">
            <p class="application-main-form__title">ユーザ情報削除が完了しました。</p>
            <a class="application-main-form__button" href="/company/user/">ユーザ情報管理トップ</a>
        </main>
    </div>
</body>
</html>
