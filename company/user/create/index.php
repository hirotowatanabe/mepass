<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = 'ユーザ情報管理／新規ユーザ登録／内容入力';

$storeNum = $comMemNameKanji = $comMemNameFurigana = $comMemPass = '';

if(isset($_SESSION['comMemCreate'])){
    $storeNum = $_SESSION['comMemCreate']['storeNum'];
    $comMemNameKanji = $_SESSION['comMemCreate']['comMemNameKanji'];
    $comMemNameFurigana = $_SESSION['comMemCreate']['comMemNameFurigana'];
    $comMemPass = $_SESSION['comMemCreate']['comMemPass'];
}

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " select * from t_store ";
    $sql .= " where com_id = '".$comId."' ";
    $stmt = $dbh->query($sql);
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $rows[] = $result;
    }
    $count = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php') ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/company/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/company/gnav.php"); ?>
        <main class="admin-main">
            <form action="/company/user/create/chk.php" method="post">
                <section class="application-main-form__section">
                    <h2 class="application-main-form__title">ユーザ情報</h2>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">所属店舗</h3>
                        <select class="application-main-form__text" name="storeNum" required>
                        <?php for($i=0; $i<$count; $i++): ?>
                            <option value="<?= $rows[$i]['store_num'] ?>"><?= $rows[$i]['store_name'] ?></option>
                        <?php endfor; ?>
                        </select>
                    </div>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">氏名(漢字)</h3>
                        <input class="application-main-form__text" type="text" name="comMemNameKanji" value="<?= $comMemNameKanji ?>" required>
                    </div>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">氏名(フリガナ)</h3>
                        <input class="application-main-form__text" type="text" name="comMemNameFurigana" value="<?= $comMemNameFurigana ?>" required>
                    </div>
                    <div class="application-main-form__item">
                        <h3 class="application-main-form__sub-title">パスワード</h3>
                        <input class="application-main-form__text" type="password" name="comMemPass" value="<?= $comMemPass ?>" required>
                    </div>
                </section>
                <input class="application-main-form__submit" type="submit" name="btn" value="次へ">
            </form>
        </main>
    </div>
</body>
</html>
