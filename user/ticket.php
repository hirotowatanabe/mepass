<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = '選択中のチケット';
$msg = '';

//メニュー選択
if(isset($_POST['menuSelectSubmit'])){
    //複数店舗同時注文不可
    $storeId = $_POST['storeId'];
    if(!isset($_SESSION['storeSelect'])){
        $_SESSION['storeSelect'] = $storeId;
    }
    if($_SESSION['storeSelect'] == $storeId){
        if(isset($_SESSION['ticket'][$_POST['id']])){
            //数量追加処理
            $_SESSION['ticket'][$_POST['id']] += $_POST['num'];
        }else{
            //新規追加処理
            $_SESSION['ticket'][$_POST['id']] = $_POST['num'];
        }
        //追加後自動遷移処理
        if($_POST['back'] == 'index'){
            header('Location: /?select=true');
            exit();
        }else if($_POST['back'] == 'detail'){
            $storeId = $_POST['storeId'];
            header('Location: /user/menu-detail.php?select=true&menuId='.$_POST['id']);
            exit();
        }
    }else{
        $msg = '1度の注文で複数の店舗に注文することは出来ません。他の店舗へ切り替えるには<a class="user-main-msg__link" href="ticket.php?reset=true">選択中のチケットをリセット</a>して下さい。';
    }
}

//数量変更
if(isset($_POST['menuChangeSubmit'])){
    //数量更新処理
    $_SESSION['ticket'][$_POST['id']] = $_POST['num'];
    $msg = '数量を更新しました。';
}

//個別削除が要求された
if(isset($_GET['delete'])){
    unset($_SESSION['ticket'][$_GET['id']]);
    $msg = '削除しました。<a class="user-main-msg__link" href="/user/store.php?id='.$_SESSION['storeSelect'].'">先程の店舗から商品を追加する。</a>';
    if(count($_SESSION['ticket']) == 0){
        unset($_SESSION['ticket']);
        unset($_SESSION['total']);
        unset($_SESSION['storeSelect']);
    }
}

//全件削除が要求された
if(isset($_GET["reset"])){
    unset($_SESSION['ticket']);
    unset($_SESSION['total']);
    unset($_SESSION['storeSelect']);
    $msg = '全て削除しました。<a class="user-main-msg__link" href="/user/search.php">店舗を検索する。</a>';
}

if(isset($_SESSION['ticket'])){
    //合計金額の初期化
    $_SESSION['total'] = 0;

    include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
    try{
        $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
        if($dbh == null){
            exit('DB接続失敗');
        }
        $dbh->query('set names utf8');
        $sql = "select * from t_menu";
        $stmt = $dbh->query($sql);
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            foreach($_SESSION['ticket'] as $id => $value){
                if($result['menu_num'] == $id){
                    $rows[] = $result;
                    $_SESSION['total'] += $result['menu_price'] * $value;
                }
            }
        }
        $count = $stmt->rowCount();
    }catch(PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
    $dbh = null;
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>
    <main class="user-main">
        <div class="user-main-ticket-top">
            <h3 class="user-main-ticket-top__title">選択中のチケット</h3>
            <?php if(isset($_SESSION['ticket'])): ?>
                <div class="user-main-ticket-top__total">支払い合計：<?= $_SESSION['total'] ?>円</div>
                <a class="user-main-ticket-top__reset" href="ticket.php?reset=true">選択中のチケットをリセット</a>
                <a class="user-main-ticket-top__button" href="/user/order/">注文に進む</a>
            <?php endif; ?>
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
        <?php if(isset($_SESSION["ticket"])): ?>
            <ul class="user-main__menu">
            <?php for($i=0; $i<count($rows); $i++): ?>
                <li class="menu-card">
                    <img class="menu-card__image" src="/store/menu/images/<?= $rows[$i]['menu_file_name'] ?>">
                    <div class="menu-card__label">
                        <p class="menu-card__name"><?= $rows[$i]['menu_name'] ?></p>
                        <p class="menu-card__price"><?= $rows[$i]['menu_price'] ?>円</p>
                    </div>
                    <div class="menu-card__box">
                        <form class="menu-card-form" action="/user/ticket.php" method="post">
                            <input type="hidden" name="id" value="<?= $rows[$i]['menu_num'] ?>">
                            <input class="menu-card-form__number" type="number" name="num" value="<?= $_SESSION['ticket'][$rows[$i]['menu_num']] ?>" min="1">
                            <span class="menu-card-form__unit">点</span>
                            <input class="menu-card-form__submit" type="submit" name="menuChangeSubmit" value="数量変更">
                        </form>
                        <a class="menu-card__delete" href="/user/ticket.php?delete=true&id=<?= $rows[$i]['menu_num'] ?>">選択を解除</a>
                    </div>
                </li>
            <?php endfor; ?>
            </ul>
        <?php else: ?>
            <p class="user-main__no-card">
                選択中のチケットはありません。
            </p>
        <?php endif; ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
