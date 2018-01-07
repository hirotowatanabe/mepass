<?php
$pageTitle = "ログイン";
header("Content-Type:text/html; charset=UTF-8");
//処理部
$errMsg = "";
$ReUrl = "";

//アクセス元URL取得
if(isset($_GET["ReUrl"])){
    $ReUrl = $_GET["ReUrl"];
}else{
    if(isset($_SERVER['HTTP_REFERER'])){
        $ReUrl = $_SERVER['HTTP_REFERER'];
    }
}

//エラーメッセージ分岐
if(isset($_GET["err"])){
    if($_GET["err"] == "1"){
        $errMsg = "パスワードに誤りがあります。";
    }else if($_GET["err"] == "2"){
        $errMsg = "入力されたメールアドレスは登録されていません。";
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body class="login">
    <h1 class="login_ttl">mepassにログイン</h1>
    <p class="login_err"><?php print $errMsg; ?></>
    <form action="chk.php" method="post">
        <p class="login_form_item">
            <input class="login_form_item_input" type="text" name="Mail" value="" placeholder="メールアドレス">
        </p>
        <p class="login_form_item">
            <input class="login_form_item_input" type="password" name="Pass" value="" placeholder="パスワード">
        </p>
            <input type="hidden" name="ReUrl" value="<?php print $ReUrl; ?>">
        <p class="login_form_item">
            <input class="login_form_item_input" type="submit" name="btn" value="ログイン">
        </p>
    </form>
    <p class="login_link">
        <a href="/user/account/create/index.php">新規登録</a>
    </p>
    <?php if($ReUrl != ""){ ?>
    <p class="login_link">
        <a href="<?php print $ReUrl; ?>">ログインをキャンセル</a>
    </p>
    <?php } ?>
</body>
</html>
