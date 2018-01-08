<?php
include($_SERVER['DOCUMENT_ROOT']."/store/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "メニュー管理";
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/store/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/store/gnav.php"); ?>
        <main class="admin-main">
            <h3 class="admin-main__title">新規メニュー登録／内容入力</h3>
            <form action="/store/menu/create/chk.php" method="post" enctype="multipart/form-data">
                <section class="admin-main-form__section">
                    <div class="admin-main-form__item">
                        <h3 class="admin-main-form__title">メニュー名</h3>
                        <input class="admin-main-form__text" type="text" name="name" value="" required>
                    </div>
                    <div class="admin-main-form__item">
                        <h3 class="admin-main-form__title">価格</h3>
                        <input class="admin-main-form__text" type="text" name="price" value="" required>
                    </div>
                    <div class="admin-main-form__item">
                        <h3 class="admin-main-form__title">画像</h3>
                        <div class="admin-main-form__file">
                            <label for="file-up">
                                <span class="admin-main-form__file-button">ファイルを選択</span>
                                <input id="file-up" class="admin-main-form__file-input" type="file" name="fileData" value="" required>
                            </label>
                        </div>
                    </div>
                </section>
                <input class="admin-main-form__submit" type="submit" name="btn" value="次へ">
            </form>
        </main>
    </div>
</body>
</html>
