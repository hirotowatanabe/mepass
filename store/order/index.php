<?php
include($_SERVER['DOCUMENT_ROOT'].'/store/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = '注文管理';

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " select * from t_order, t_member ";
    $sql .= " where t_order.mem_mail = t_member.mem_mail ";
    $sql .= " and t_order.store_num = ".$storeNum;
    $sql .= " order by t_order.order_datetime ";
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
    <?php include($_SERVER['DOCUMENT_ROOT'].'/store/header.php'); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/store/gnav.php'); ?>
        <main class="admin-main">
            <?php if($count != 0): ?>
            <table>
                <tr>
                    <th>注文番号</th><th>お客様名</th><th>決済方法</th><th>来店予定日時</th>
                </tr>
                <?php for($i=0; $i<$count; $i++): ?>
                <tr>
                    <td><a href="/store/order/detail.php?id=<?= $rows[$i]['order_num'] ?>"><?= $rows[$i]['order_num'] ?></a></td>
                    <td><?= $rows[$i]['mem_name'] ?>様</td>
                    <td><?= $rows[$i]['order_pay'] ?></td>
                    <td><?= $rows[$i]['order_datetime'] ?></td>
                </tr>
                <?php endfor; ?>
            </table>
            <?php else: ?>
                <p>注文はありません。</p>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
