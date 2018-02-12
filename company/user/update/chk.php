<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = 'ユーザ情報管理／ユーザ情報変更／内容確認';

$comMemNum = $storeNum = $comMemNameKanji = $comMemNameFurigana = $comMemPass = '';

$comMemNum = $_POST['comMemNum'];
$storeNum = $_POST['storeNum'];
$comMemNameKanji = $_POST['comMemNameKanji'];
$comMemNameFurigana = $_POST['comMemNameFurigana'];
$comMemPass = $_POST['comMemPass'];

$_SESSION['comMemUpdate']['comMemNum'] = $comMemNum;
$_SESSION['comMemUpdate']['storeNum'] = $storeNum;
$_SESSION['comMemUpdate']['comMemNameKanji'] = $comMemNameKanji;
$_SESSION['comMemUpdate']['comMemNameFurigana'] = $comMemNameFurigana;
$_SESSION['comMemUpdate']['comMemPass'] = $comMemPass;

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " select * from t_store ";
    $sql .= " where store_num = ".$_SESSION['comMemUpdate']['storeNum'];
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/company/header.php'); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/company/gnav.php'); ?>
        <main class="admin-main">
            <section class="application-main-form__section">
                <h2 class="application-main-form__title">ユーザ情報</h2>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">所属店舗</h3>
                    <span class="application-main-disp__value"><?= $result['store_name'] ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">氏名(漢字)</h3>
                    <span class="application-main-disp__value"><?= $_SESSION['comMemUpdate']['comMemNameKanji'] ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">氏名(フリガナ)</h3>
                    <span class="application-main-disp__value"><?= $_SESSION['comMemUpdate']['comMemNameFurigana'] ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">パスワード</h3>
                    <span class="application-main-disp__value">※個人情報保護の為、表示しておりません。</span>
                </div>
            </section>
            <a class="application-main-form__button" href="/company/user/update/ex.php">確定</a>
            <a class="application-main-form__button" href="/company/user/update/?num=<?= $_SESSION['comMemUpdate']['comMemNum'] ?>">戻る</a>
        </main>
    </div>
</body>
</html>
