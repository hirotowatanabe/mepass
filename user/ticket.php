<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = '選択中のチケット';
$msg = '';

//メニュー選択
if(isset($_POST['menuSelectSubmit'])){
    if(isset($_SESSION['ticket'][$_POST['id']])){
        //数量追加処理
        $_SESSION['ticket'][$_POST['id']] += $_POST['num'];
    }else{
        //新規追加処理
        $_SESSION['ticket'][$_POST['id']] = $_POST['num'];
    }
    header('Location: /?select=true');
    exit();
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
    $msg = '削除しました。';
    if(count($_SESSION['ticket']) == '0'){
        unset($_SESSION["ticket"]);
    }
}

//全件削除が要求された
if(isset($_GET["reset"])){
    unset($_SESSION["ticket"]);
    $msg = '全て削除しました。';
}

if(isset($_SESSION['ticket'])){
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
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main">
        <div class="user-main-ticket-top">
            <h3 class="user-main-ticket-top__title">選択中のチケット</h3>
            <?php if(isset($_SESSION["ticket"])): ?>
                <a class="user-main-ticket-top__reset" href="ticket.php?reset=true">選択中のチケットをリセット</a>
                <a class="user-main-ticket-top__button" href="order.php">注文に進む</a>
            <?php endif; ?>
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
        <?php if(isset($_SESSION["ticket"])): ?>
            <ul class="user-main__menu">
            <?php for($i=0; $i<count($rows); $i++): ?>
                <li class="menu-card">
                    <div class="menu-card__image-container">
                        <img src="/store/menu/images/<?= $rows[$i]['menu_file_name'] ?>" width="300">
                    </div>
                    <div class="menu-card__name"><?= $rows[$i]['menu_name'] ?></div>
                    <div class="menu-card__price"><?= $rows[$i]['menu_price'] ?>円</div>
                    <form class="menu-card-form" action="/user/ticket.php" method="post">
                        <input type="hidden" name="id" value="<?= $rows[$i]['menu_num'] ?>">
                        <input class="menu-card-form__number" type="number" name="num" value="<?= $_SESSION['ticket'][$rows[$i]['menu_num']] ?>" min="1">点
                        <input class="menu-card-form__submit" type="submit" name="menuChangeSubmit" value="数量変更">
                    </form>
                    <a class="menu-card__delete" href="/user/ticket.php?delete=true&id=<?= $rows[$i]['menu_num'] ?>">削除</a>
                </li>
            <?php endfor; ?>
            </ul>
        <?php else: ?>
            選択中のチケットはありません。
        <?php endif; ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
