<?php
include($_SERVER['DOCUMENT_ROOT']."/store/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "メニュー管理";
$searchValue = "";
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/store/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/store/gnav.php"); ?>
        <main class="admin-main">
            <div class="admin-main-top">
                <form action="index.php" method="post">
                    <input class="admin-main-top-form__text" type="text" name="userSearch" value="<?php print $searchValue; ?>" placeholder="メニュー名検索" />
                    <input class="admin-main-top-form__submit" type="submit" name="btn" value="検索" />
                </form>
                <a class="admin-main-top__button" href="/store/menu/create/">新規メニュー登録</a>
            </div>
        </main>
    </div>
</body>
</html>
