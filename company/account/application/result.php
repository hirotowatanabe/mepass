<?php
session_start();
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = '登録完了 | 新規加盟企業登録';
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body class="application">
    <?php include($_SERVER['DOCUMENT_ROOT']."/company/account/application/header.php"); ?>
    <main class="application-main">
        <div class="application-main-form">
            <p class="application-main-form__description">登録が完了しました。</p>
            <a class="application-main-form__button" href="/company/">企業ページへ進む</a>
        </div>
    </main>
</body>
</html>
