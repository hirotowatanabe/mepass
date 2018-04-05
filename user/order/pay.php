<?php
header('Content-Type:text/html; charset=UTF-8');
//ログイン必須
$loginRequired = 'true';
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = 'ご注文内容確認／決済';
$msg = '';

//意図しないアクセスは強制リダイレクト
if(!isset($_POST['btn'])){
    header('Location: /user/order/');
}

//チケットセッションが存在しない場合は強制リダイレクト
if(!isset($_SESSION['ticket'])){
    header('Location: /user/ticket.php');
}

$_SESSION['order']['date'] = $_POST['date'];
$_SESSION['order']['time'] = $_POST['time'];

if(isset($_SESSION['ticket'])){

    include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
    try{
        $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
        if($dbh == null){
            exit('DB接続失敗');
        }
        $dbh->query('set names utf8');
        $sql = " select * from t_menu, t_store ";
        $sql .= " where t_menu.store_num = t_store.store_num ";
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
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>
    <main class="user-main">
        <div class="user-main-ticket-top">
            <h3 class="user-main-ticket-top__title">ご注文内容確認／決済</h3>
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
        <div class="order-main">
            <section class="order-main__section">
                <h4 class="order-main__title">ご注文内容</h4>
                <ul class="order-main-content">
                <?php for($i=0; $i<count($rows); $i++): ?>
                    <li class="order-main-content__list">
                        <p class="order-main-content__item"><?= $rows[$i]['menu_name'] ?></p>
                        <p class="order-main-content__item"><?= $rows[$i]['menu_price'] ?>円</p>
                        <p class="order-main-content__item"><?= $_SESSION['ticket'][$rows[$i]['menu_num']] ?>点</p>
                    </li>
                <?php endfor; ?>
                </ul>
                <div class="order-main-due order-main-due--mb">
                    <p class="order-main-due__item">お支払い合計</p>
                    <p class="order-main-due__item"><span class="js-total-due"><?= $_SESSION['total'] ?></span>円</p>
                </div>
                <h4 class="order-main__title">注文先店舗</h4>
                <div class="order-main-due order-main-due--mb">
                    <p class="order-main-due__item order-main-due__item--center"><?= $rows[0]['store_name'] ?></p>
                </div>
                <h4 class="order-main__title">来店予定日時</h4>
                <div class="order-main-due">
                    <p class="order-main-due__item order-main-due__item--center"><?= $_SESSION['order']['date'] ?>&nbsp;<?= $_SESSION['order']['time'] ?></p>
                </div>
            </section>
            <section class="order-main__section order-main__section--bg">
                <h4 class="order-main__title">決済方法</h4>
                <ul class="order-main-btn-list">
                    <li class="order-main-btn-list__item">
                        <a class="order-main-btn-list__button js-pay-local" href="javascript:void(0);">現地決済</a>
                    </li>
                    <li class="order-main-btn-list__item">
                        <a class="order-main-btn-list__button js-pay-credit" href="javascript:void(0);">クレジットカード決済</a>
                    </li>
                    <li class="order-main-btn-list__item">
                        <a class="order-main-btn-list__reset" href="/user/order/">来店予定日時選択に戻る</a>
                    </li>
                </ul>
            </section>
        </div>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
</body>
