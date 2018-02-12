<?php
session_start();
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = '登録内容確認 | 新規加盟企業登録';
//企業情報変数宣言
$comId = $comName = $comPost = $comPref = $comCity = $comAdd = $comTel = $comMail = $comPass = '';

//企業情報受け取り
if(isset($_POST['next'])){
    $comId = $_POST['comId'];
    $comName = $_POST['comName'];
    $comPost = $_POST['comPost'];
    $comPref = $_POST['comPref'];
    $comCity = $_POST['comCity'];
    $comAdd = $_POST['comAdd'];
    $comTel = $_POST['comTel'];
    $comMail = $_POST['comMail'];
    $comPass = $_POST['comPass'];
}

//企業情報セッション格納
$_SESSION['application']['comId'] = $comId;
$_SESSION['application']['comName'] = $comName;
$_SESSION['application']['comPost'] = $comPost;
$_SESSION['application']['comPref'] = $comPref;
$_SESSION['application']['comCity'] = $comCity;
$_SESSION['application']['comAdd'] = $comAdd;
$_SESSION['application']['comTel'] = $comTel;
$_SESSION['application']['comMail'] = $comMail;
$_SESSION['application']['comPass'] = $comPass;
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body class="application">
<?php include($_SERVER['DOCUMENT_ROOT']."/company/account/application/header.php"); ?>
    <main class="application-main">
        <div class="application-main-form">
            <p class="application-main-form__description">登録内容をご確認ください。</p>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">企業ページアクセス情報</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">企業ID</h3>
                    <span class="application-main-disp__value"><?= $_SESSION["application"]["comId"] ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">パスワード</h3>
                    <span class="application-main-disp__value">セキュリティの為、非表示</span>
                </div>
            </section>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">企業名</h2>
                <div class="application-main-form__item">
                    <span class="application-main-disp__value"><?= $_SESSION["application"]["comName"] ?></span>
                </div>
            </section>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">所在地</h2>
                <div class="application-main-form__item">
                    <span class="application-main-disp__value">〒<?= $_SESSION["application"]["comPost"] ?><br>
                    <?= $_SESSION["application"]["comPref"].$_SESSION["application"]["comCity"].$_SESSION["application"]["comAdd"]; ?></span>
                </div>
            </section>
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">連絡先</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main_form__sub-title">電話番号</h3>
                    <span class="application-main-disp__value"><?= $_SESSION["application"]["comTel"]; ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">メールアドレス</h3>
                    <span class="application-main-disp__value"><?= $_SESSION["application"]["comMail"] ?></span>
                </div>
            </section>
            <a class="application-main-form__button" href="/company/account/application/ex.php?ex=true">確定</a>
            <a class="application-main-form__button" href="/company/account/application/">戻る</a>
        </div>
    </main>
</body>
</html>
