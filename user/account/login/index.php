<?php
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = 'ログイン';
$errMsg = '';
$reUrl = '';

//アクセス元URL取得
if(isset($_GET['reUrl'])){
    $reUrl = $_GET['reUrl'];
}else{
    if(isset($_SERVER['HTTP_REFERER'])){
        $reUrl = $_SERVER['HTTP_REFERER'];
    }
}

//エラーメッセージ分岐
if(isset($_GET['err'])){
    if($_GET['err'] == '1'){
        $errMsg = "パスワードに誤りがあります。";
    }else if($_GET['err'] == '2'){
        $errMsg = '入力されたメールアドレスは登録されていません。';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body class="login">
    <h1 class="login__title">mepassにログイン</h1>
    <p class="login__err"><?= $errMsg ?></>
    <form action="chk.php" method="post">
        <p class="login-form__item">
            <input class="login-form__text" type="text" name="mail" value="" placeholder="メールアドレス">
        </p>
        <p class="login-form__item">
            <input class="login-form__text" type="password" name="pass" value="" placeholder="パスワード">
        </p>
            <input type="hidden" name="reUrl" value="<?= $reUrl ?>">
        <p class="login-form__item">
            <input class="login-form__submit" type="submit" name="btn" value="ログイン">
        </p>
    </form>
    <p class="login__link">
        <a href="/user/account/create/">新規登録</a>
    </p>
    <?php if($reUrl != ''): ?>
    <p class="login__link">
        <a href="<?= $reUrl ?>">ログインをキャンセル</a>
    </p>
    <?php endif; ?>
</body>
</html>
