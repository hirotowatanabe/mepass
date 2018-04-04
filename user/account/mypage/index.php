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
    $sql = " select distinct t_order.order_num, t_order.order_datetime, t_store.store_name ";
    $sql .= " from t_order, t_order_ticket, t_menu, t_store ";
    $sql .= " where t_order.mem_mail = '".$UserMail."' ";
    $sql .= " and t_order.order_num = t_order_ticket.order_num ";
    $sql .= " and t_order_ticket.menu_num = t_menu.menu_num ";
    $sql .= " and t_menu.store_num = t_store.store_num ";
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
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main user-mypage">
        <section class="user-mypage-section">
            <h2 class="user-mypage-section__title">注文一覧</h2>
            <p>注文番号選択で詳細を確認できます。</p>
            <?php if($count != 0): ?>
            <table>
                <tr><th>注文番号</th><th>来店予定日時</th><th>店舗名</th></tr>
                <?php for($i=0; $i<count($rows); $i++): ?>
                <?php $dt = strtotime($rows[$i]['order_datetime']); ?>
                <tr>
                    <td><a href="/user/account/mypage/ticket/detail.php?id=<?= $rows[$i]['order_num'] ?>"><?= $rows[$i]['order_num'] ?></a></td>
                    <td><?= date('Y-m-d H:i', $dt) ?></td>
                    <td><?= $rows[$i]['store_name'] ?></td>
                </tr>
                <?php endfor; ?>
            </table>
            <?php else: ?>
                注文はありません。
            <?php endif; ?>
        </section>
        <section class="user-mypage-section">
            <h2 class="user-mypage-section__title">アカウント管理</h2>
            <a class="" href="/user/account/delete/">アカウントの削除</a>
        </section>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
</html>
