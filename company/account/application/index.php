<?php
session_start();
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = '企業情報入力 | 新規加盟企業登録';

//企業情報変数宣言
$comId = $comName = $comPost = $comPref = $comCity = $comAdd = $comTel = $comMail = $comPass = '';

//企業情報取得
if(isset($_SESSION['application']['comId'])){
    $comId = $_SESSION['application']['comId'];
    $comName = $_SESSION['application']['comName'];
    $comPost = $_SESSION['application']['comPost'];
    $comPref = $_SESSION['application']['comPref'];
    $comCity = $_SESSION['application']['comCity'];
    $comAdd = $_SESSION['application']['comAdd'];
    $comTel = $_SESSION['application']['comTel'];
    $comMail = $_SESSION['application']['comMail'];
    $comPass = $_SESSION['application']['comPass'];
}

?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body class="application">
<?php include($_SERVER['DOCUMENT_ROOT'].'/company/account/application/header.php'); ?>
    <main class="application-main">
        <form class="application-main-form" method="post" action="chk.php">
            <p class="application-main-form__description">企業情報入力を入力してください。</p>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">企業ページアクセス情報</h2>
                <p class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">企業ID（半角英数記号20字以内）</h3>
                    <input class="application-main-form__text" type="text" name="comId" value="<?= $comId ?>" required>
                </p>
                <p class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">パスワード（半角英数記号20字以内）</h3>
                    <input class="application-main-form__text" type="password" name="comPass" value="<?= $comPass ?>" required>
                </p>
            </section>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">企業名</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">正式名称</h3>
                    <input class="application-main-form__text" type="text" name="comName" value="<?= $comName ?>" required>
                </div>
            </section>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">所在地</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">郵便番号（ハイフンを含む）</h3>
                    <input class="application-main-form__text" type="text" name="comPost" value="<?= $comPost ?>" required>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">都道府県</h3>
                    <input class="application-main-form__text" type="text" name="comPref" value="<?= $comPref ?>" required>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">市区町村</h3>
                    <input class="application-main-form__text" type="text" name="comCity" value="<?= $comCity ?>" required>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">番地以降</h3>
                    <input class="application-main-form__text" type="text" name="comAdd" value="<?= $comAdd ?>">
                </div>
            </section>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">連絡先</h2>
                <p class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">電話番号（ハイフンは含まない）</h3>
                    <input class="application-main-form__text" type="text" name="comTel" value="<?= $comTel ?>" required>
                </p>
                <p class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">メールアドレス</h3>
                    <input class="application-main-form__text" type="email" name="comMail" value="<?= $comMail ?>" required>
                </p>
            </section>
            <input class="application-main-form__submit" type="submit" name="next" value="次へ">
        </form>
    </main>
</body>
</html>
