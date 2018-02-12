<?php
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = '企業管理ログイン';
$errMsg = $id = '';

if(isset($_GET['err'])){
    if($_GET['err'] == '1'){
        $errMsg = 'パスワードに誤りがあります。';
    }else if($_GET['err'] == '2'){
        $errMsg = '入力された企業IDは登録されていません';
    }
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body class="login login--admin">
    <h1 class="login__title">mepass企業管理にログイン</h1>
    <p class="login__err"><?= $errMsg ?></p>
    <form action="chk.php" method="post">
        <p class="login-form__item">
            <input class="login-form__text" type="text" name="id" value="<?= $id ?>" placeholder="企業ID" required>
        </p>
        <p class="login-form__item">
            <input class="login-form__text" type="password" name="pass" value="" placeholder="パスワード" required>
        </p>
        <p class="login-form__item">
            <input class="login-form__submit" type="submit" name="btn" value="ログイン">
        </p>
    </form>
    <p class="login__link">
        <a href="/store/account/login/">店舗業務管理はこちら</a>
    </p>
    <p class="login__link">
        <a href="/company/account/application/">新規加盟企業登録</a>
    </p>
</html>
