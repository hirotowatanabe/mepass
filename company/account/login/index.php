<?php
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = '企業管理ログイン';
$errMsg = '';

if(isset($_GET['err'])){
    if($_GET['err'] == '1'){
        $errMsg = 'パスワードに誤りがあります。';
    }else if($_GET['err'] == '2'){
        $errMsg = '入力された企業番号は登録されていません';
    }
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
            <input class="login-form__text" type="text" name="num" value="" placeholder="企業番号">
        </p>
        <p class="login-form__item">
            <input class="login-form__text" type="password" name="pass" value="" placeholder="パスワード">
        </p>
        <p class="login-form__item">
            <input class="login-form__submit" type="submit" name="btn" value="ログイン">
        </p>
    </form>
    <p class="login__link">
        <a href="/store/account/login/">店舗業務管理はこちら</a>
    </p>
    <p class="login__link">
        <a href="/company/account/application/select_plan.php">加盟店契約お申し込みはこちら</a>
    </p>
</html>
