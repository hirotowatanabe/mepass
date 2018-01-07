<?php
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "店舗業務管理ログイン";
$errMsg = "";
//エラーメッセージ分岐
if(isset($_GET["err"])){
    if($_GET["err"] == "1"){
        $errMsg = "パスワードに誤りがあります。";
    }else if($_GET["err"] == "2"){
        $errMsg = "入力された管理者番号は登録されていません。";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body class="login login--admin">
    <h1 class="login__title">mepass店舗業務管理にログイン</h1>
    <p class="login__err"><?php print $errMsg; ?></>
    <form action="chk.php" method="post">
        <p class="login-form__item">
            <input class="login-form__text" type="text" name="num" value="" placeholder="管理者番号">
        </p>
        <p class="login-form__item">
            <input class="login-form__text" type="password" name="pass" value="" placeholder="パスワード">
        </p>
        <p class="login-form__item">
            <input class="login-form__submit" type="submit" name="btn" value="ログイン">
        </p>
    </form>
    <p class="login__link">
        <a href="/company/account/login/">企業管理はこちら</a>
    </p>
</html>
