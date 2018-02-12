<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = 'ユーザ情報管理／詳細';
$comMemNum = '';

if(isset($_GET['num'])){
    $comMemNum = $_GET['num'];
}
include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " select * from t_company_member, t_store ";
    $sql .= " where t_company_member.com_mem_num = ".$comMemNum;
    $sql .= " and t_company_member.store_num = t_store.store_num";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    $comMemNum = $dbh->lastInsertId('com_mem_num');
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
                    <h3 class="application-main-form__sub-title">管理者番号</h3>
                    <span class="application-main-disp__value"><?= $result['com_mem_num'] ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">所属店舗</h3>
                    <span class="application-main-disp__value"><?= $result['store_name'] ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">氏名(漢字)</h3>
                    <span class="application-main-disp__value"><?= $result['com_mem_name_kanji']; ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">氏名(フリガナ)</h3>
                    <span class="application-main-disp__value"><?= $result['com_mem_name_furigana']; ?></span>
                </div>
                <div class="application-main-form__item">
                    <h3 class="application-main-form__sub-title">パスワード</h3>
                    <span class="application-main-disp__value">※個人情報保護の為、表示しておりません。
                </div>
            </section>
            <a class="application-main-form__button" href="/company/user/update/?num=<?= $result['com_mem_num'] ?>">ユーザ情報変更</a>
            <a class="application-main-form__button" href="/company/user/delete/?num=<?= $result['com_mem_num']; ?>">ユーザ情報削除</a>
        </main>
    </div>
</body>
</html>
