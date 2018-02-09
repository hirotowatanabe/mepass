<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = '検索';
$msg = '';

//検索条件初期化
$name = '';
$pref = '';
$city = '';
$add = '';

if(isset($_POST['searchSubmit'])){
    $name = $_POST['name'];
    $pref = $_POST['pref'];
    $city = $_POST['city'];
    $add = $_POST['add'];

    include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
    try{
        $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
        if($dbh == null){
            exit('DB接続失敗');
        }
        $dbh->query('set names utf8');
        $sql = " select * from t_store ";
        $sql .= " where store_name like '%".$name."%' ";
        $sql .= " and store_pref like '%".$pref."%' ";
        $sql .= " and store_city like '%".$city."%' ";
        $sql .= " and store_add like '%".$add."%' ";
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

    $msg = $count.'件見つかりました。';
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main">
        <div class="user-main-ticket-top">
            <h3 class="user-main-ticket-top__title">店舗検索</h3>
            <form class="user-main-search__form" action="search.php" method="post">
                <section class="user-main-form__section">
                    <h4 class="user-main-form__title">店舗名指定</h4>
                    <input class="user-main-form__text" type="text" name="name" value="<?= $name ?>" />
                </section>
                <section class="user-main-form__section">
                    <h4 class="user-main-form__title">エリア指定</h4>
                    <div class="user-main-form__item">
                        都道府県<input class="user-main-form__text" type="text" name="pref" value="<?= $pref ?>" />
                    </div>
                    <div class="user-main-form__item">
                        市区町村<input class="user-main-form__text" type="text" name="city" value="<?= $city ?>" />
                    </div>
                    <div class="user-main-form__item">
                        番地以降<input class="user-main-form__text" type="text" name="add" value="<?= $add ?>" />
                    </div>
                </section>
                <input class="user-main-search__submit" type="submit" name="searchSubmit" value="検索開始" />
            </form>
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
        <section class="user-main-form__section">
        <?php if(isset($_POST['searchSubmit'])): ?>
            <?php if($count != 0): ?>
                <table>
                <?php for($i=0; $i<count($rows); $i++): ?>
                    <tr>
                        <td><a href="/user/store.php?id=<?= $rows[$i]['store_num'] ?>"><?= $rows[$i]['store_name'] ?></a></td>
                    </tr>
                <?php endfor; ?>
                </table>
            <?php else: ?>
                <p>
                    該当結果はありません。条件を変更して検索してください。
                </p>
            <?php endif; ?>
        <?php endif; ?>
        </section>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
