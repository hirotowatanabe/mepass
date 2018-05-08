<?php
header('Content-Type:text/html; charset=UTF-8');
//ログイン必須
$loginRequired = 'true';
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = 'マイページ';

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " select * from t_order, t_store ";
    $sql .= " where t_order.mem_mail = '".$UserMail."' ";
    $sql .= " and t_order.store_num = t_store.store_num ";
    //現在日時より後の注文を抽出
    $sql .= " and t_order.order_datetime >= now() ";
    $sql .= " order by t_order.order_datetime desc ";
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
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>
    <main class="user-main user-mypage">
        <section class="user-mypage-section">
            <h2 class="user-mypage-section__title">直近のご注文</h2>
            <?php if($count != 0): ?>
            <ul class="order-card-container">
                <?php for($i=0; $i<count($rows); $i++): ?>
                <?php $dt = strtotime($rows[$i]['order_datetime']); ?>
                <li class="order-card">
                    <a class="order-card__link" href="/user/account/mypage/ticket/detail.php?id=<?= $rows[$i]['order_num'] ?>">
                        <p class="order-card__num">注文番号：<?= $rows[$i]['order_num'] ?></p>
                        <p class="order-card__time"><i class="fa fa-clock-o" aria-hidden="true"></i><?= date('Y-m-d H:i', $dt) ?></p>
                        <p class="order-card__place"><i class="fa fa-map-marker" aria-hidden="true"></i><?= $rows[$i]['store_name'] ?></p>
                    </a>
                </li>
                <?php endfor; ?>
            </ul>
            <?php else: ?>
                予約中の注文はありません。
            <?php endif; ?>
            <ul class="list-menu">
                <li class="list-menu__item">
                    <a class="list-menu__link" href="/user/account/mypage/ticket/history.php">注文履歴一覧</a>
                </li>
            </ul>
        </section>
        <section class="user-mypage-section">
            <h2 class="user-mypage-section__title">アカウント管理</h2>
            <ul class="list-menu">
                <li class="list-menu__item">
                    <a class="list-menu__link" href="/user/account/delete/">アカウントの削除</a>
                </li>
                <li class="list-menu__item">
                    <a class="list-menu__link" href="javascript:void(0)">ユーザー名の変更（準備中）</a>
                </li>
                <li class="list-menu__item">
                    <a class="list-menu__link" href="javascript:void(0)">パスワードの変更（準備中）</a>
                </li>
            </ul>
        </section>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
</body>
</html>
