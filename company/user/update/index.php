<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = 'ユーザ情報管理／ユーザ情報変更／内容入力';

$comMemNum = $storeNum = $comMemNameKanji = $comMemNameFurigana = $comMemPass = '';

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
    $storeSql = " select * from t_store ";
    $storeSql .= " where com_id = '".$comId."' ";
    $stmt = $dbh->query($storeSql);
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $rows[] = $result;
    }
    $storeCount = $stmt->rowCount();
    $userSql = " select * from t_company_member ";
    $userSql .= " where com_mem_num = ".$comMemNum;
    $stmt = $dbh->query($userSql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $userCount = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;

if(isset($_SESSION['comMemUpdate'])){
    $storeNum = $_SESSION['comMemUpdate']['storeNum'];
    $comMemNameKanji = $_SESSION['comMemUpdate']['comMemNameKanji'];
    $comMemNameFurigana = $_SESSION['comMemUpdate']['comMemNameFurigana'];
    $comMemPass = $_SESSION['comMemUpdate']['comMemPass'];
}else{
    $storeNum = $result['store_num'];
    $comMemNameKanji = $result['com_mem_name_kanji'];
    $comMemNameFurigana = $result['com_mem_name_furigana'];
    $comMemPass = $result['com_mem_pass'];
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/company/header.php'); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/company/gnav.php'); ?>
        <main class="admin-main">
            <form action="/company/user/update/chk.php" method="post">
                <section class="application-main-form__section">
                    <h2 class="application-main-form__title">ユーザ情報</h2>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">所属店舗</h3>
                        <select class="application-main-form__text" name="storeNum">
                        <?php for($i=0; $i<$storeCount; $i++): ?>
                            <option value="<?= $rows[$i]['store_num'] ?>" <?php if($rows[$i]['store_num'] == $storeNum){ echo 'selected'; } ?>><?= $rows[$i]['store_name'] ?></option>
                        <?php endfor; ?>
                        </select>
                    </div>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">氏名(漢字)</h3>
                        <input class="application-main-form__text" type="text" name="comMemNameKanji" value="<?= $comMemNameKanji ?>">
                    </div>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">氏名(フリガナ)</h3>
                        <input class="application-main-form__text" type="text" name="comMemNameFurigana" value="<?= $comMemNameFurigana ?>">
                    </div>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">パスワード</h3>
                        <input class="application-main-form__text" type="password" name="comMemPass" value="<?= $comMemPass ?>">
                    </div>
                </section>
                <input type="hidden" name="comMemNum" value="<?= $comMemNum ?>">
                <input class="application-main-form__submit" type="submit" name="btn" value="次へ">
            </form>
        </main>
    </div>
</body>
</html>
