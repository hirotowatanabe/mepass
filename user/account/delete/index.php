<?php
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = 'アカウントの削除';
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
    <h1 class="login__title">アカウントの削除</h1>
    <p class="login__link">
        <a href="/user/account/delete/ex.php">確定</a>
    </p>
    <?php if($reUrl != ''): ?>
    <p class="login__link">
        <a href="<?= $reUrl ?>">キャンセル</a>
    </p>
    <?php endif; ?>
</body>
</html>
