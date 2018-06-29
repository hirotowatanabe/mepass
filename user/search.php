<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = '検索';
$msg = '';

//検索条件初期化
$name = $pref = $city = $add = '';

if(isset($_POST['searchSubmit'])){
    $name = $_POST['name'];
    if(isset($_POST['pref'])){
        $pref = $_POST['pref'];
        $city = $_POST['city'];
        $add = $_POST['add'];
    }

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
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>
    <main class="user-main">
        <div class="user-main__section user-main__section--p50 user-main__section--bg-orange">
            <h3 class="user-main__title user-main__title--fc-white">お店を探す</h3>
            <form class="user-main-search" action="/user/search.php#result" method="post">
                <section class="user-main-search__unit">
                    <h4 class="user-main-search__title">店舗名指定</h4>
                    <input class="user-main-search__input" type="text" name="name" value="<?= $name ?>">
                </section>
                <section class="user-main-search__unit">
                    <h4 class="user-main-search__title">エリア指定</h4>
                    <ul class="user-main-search__list">
                        <li class="user-main-search__item">
                            <span>都道府県</span>
                            <input class="user-main-search__input user-main-search__input--small" type="text" name="pref" value="<?= $pref ?>">
                        </li>
                        <li class="user-main-search__item">
                            <span>市区町村</span>
                            <input class="user-main-search__input user-main-search__input--small" type="text" name="city" value="<?= $city ?>">
                        </li>
                        <li class="user-main-search__item">
                            <span>番地以降</span>
                            <input class="user-main-search__input user-main-search__input--small" type="text" name="add" value="<?= $add ?>">
                        </li>
                    </ul>
                </section>
                <input class="user-main-search__button" type="submit" name="searchSubmit" value="検索開始">
            </form>
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
        <div id="result" class="user-main__section user-main__section--plr50">
        <?php if(isset($_POST['searchSubmit'])): ?>
            <?php if($count != 0): ?>
                <ul class="list-menu">
                <?php for($i=0; $i<count($rows); $i++): ?>
                    <li class="list-menu__item">
                        <a class="list-menu__link" href="/user/store.php?id=<?= $rows[$i]['store_num'] ?>"><?= $rows[$i]['store_name'] ?></a>
                    </li>
                <?php endfor; ?>
                </ul>
            <?php else: ?>
                <p>
                    該当結果はありません。条件を変更して検索してください。
                </p>
            <?php endif; ?>
        <?php endif; ?>
        </div>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
</body>
