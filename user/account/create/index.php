<?php
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = '新規アカウント作成';
$reUrl = '';

//アクセス元URL取得
if(isset($_GET['reUrl'])){
    $reUrl = $_GET['reUrl'];
}else{
    if(isset($_SERVER['HTTP_REFERER'])){
        $reUrl = $_SERVER['HTTP_REFERER'];
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body class="login">
    <h1 class="login__title">アカウントの作成</h1>
    <form action="ex.php" method="post">
        <p class="login-form__item">
            <input class="login-form__text" type="text" name="mail" value="" placeholder="メールアドレス">
        </p>
        <p class="login-form__item">
            <input class="login-form__text" type="password" name="pass" value="" placeholder="パスワード">
        </p>
        <p class="login-form__item">
            <input class="login-form__text" type="text" name="name" value="" placeholder="お名前">
        </p>
            <input type="hidden" name="reUrl" value="<?= $reUrl ?>">
        <p class="login-form__item">
            <input class="login-form__submit" type="submit" name="btn" value="登録">
        </p>
    </form>
    <p class="login__link">
        <a href="/user/account/login/">ログイン</a>
    </p>
    <?php if($reUrl != ''): ?>
    <p class="login__link">
        <a href="<?= $reUrl ?>">キャンセル</a>
    </p>
    <?php endif; ?>
</body>
</html>
