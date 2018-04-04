<?php
header("Content-Type:text/html; charset=UTF-8");
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
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
    }else if($_GET['err'] == '3'){
        $errMsg = 'これより先はログインが必要です。';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main user-account">
        <h1 class="user-account__title">ログイン</h1>
        <?php if($errMsg != ''): ?>
        <p class="user-account__err"><?= $errMsg ?>
        <?php endif; ?>
        <form action="chk.php" method="post">
            <p class="user-account-form__item">
                <input class="user-account-form__text" type="text" name="mail" value="" placeholder="メールアドレス" required>
            </p>
            <p class="user-account-form__item">
                <input class="user-account-form__text" type="password" name="pass" value="" placeholder="パスワード" required>
            </p>
                <input type="hidden" name="reUrl" value="<?= $reUrl ?>">
            <p class="user-account-form__item">
                <input class="user-account-form__submit" type="submit" name="btn" value="ログイン">
            </p>
        </form>
        <p class="user-account__link">
            <a href="/user/account/create/">新規登録</a>
        </p>
        <?php if($reUrl != ''): ?>
        <p class="user-account__link">
            <a href="<?= $reUrl ?>">ログインをキャンセル</a>
        </p>
        <?php endif; ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
</html>
