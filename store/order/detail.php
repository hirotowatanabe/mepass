<?php
include($_SERVER['DOCUMENT_ROOT'].'/store/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = '注文管理';
$id = '';
if(isset($_GET['id'])){
    $id = $_GET['id'];
}

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');

    //ステータス更新
    if(isset($_GET['changeStatus'])){
        $mid = $_GET['mid'];
        $status = $_GET['changeStatus'];
        $sql = " update t_order_ticket set ot_status = :status where order_num = :id and menu_num = :mid";
        $stmt = $dbh->prepare($sql);
        $params = array(':status' => $status, ':id' => $id, ':mid' => $mid);
        $stmt->execute($params);
    }

    //顧客情報取得
    $orderSql = " select * from t_order, t_member ";
    $orderSql .= " where t_order.order_num = ".$id;
    $orderSql .= " and t_order.mem_mail = t_member.mem_mail ";
    $stmt = $dbh->query($orderSql);
    $orderResult = $stmt->fetch(PDO::FETCH_ASSOC);
    $orderCount = $stmt->rowCount();

    //提供商品情報取得
    $productSql = " select * from t_order_ticket, t_menu ";
    $productSql .= " where t_order_ticket.order_num = ".$id;
    $productSql .= " and t_order_ticket.menu_num = t_menu.menu_num ";
    $stmt = $dbh->query($productSql);
    while($productResult = $stmt->fetch(PDO::FETCH_ASSOC)){
        $rows[] = $productResult;
        if($productResult['ot_status'] == '1'){
            $dispStatus[] = '未提供';
        }else if($productResult['ot_status'] == '2'){
            $dispStatus[] = '提供済み';
        }else if($productResult['ot_status'] == '3'){
            $dispStatus[] = 'キャンセル済み';
        }
    }
    $productCount = $stmt->rowCount();
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
            <section class="admin-main-section">
                <h3 class="admin-main__title">お客様基本情報</h3>
                <?php if($orderCount != 0): ?>
                <table>
                    <tr>
                        <th>注文番号</th><th>お客様名</th><th>決済方法</th><th>来店予定日時</th>
                    </tr>
                    <tr>
                        <td><?= $orderResult['order_num'] ?></td>
                        <td><?= $orderResult['mem_name'] ?>様</td>
                        <td><?= $orderResult['order_pay'] ?></td>
                        <td><?= $orderResult['order_datetime'] ?></td>
                    </tr>
                </table>
                <?php else: ?>
                    <p>注文データがありません。</p>
                <?php endif; ?>
            </section>

            <section class="admin-main-section">
                <h3 class="admin-main__title">提供商品情報</h3>
                <?php if($productCount != 0): ?>
                <table>
                    <tr>
                        <th>提供商品</th><th>数量</th><th>ステータス</th><th>ステータス変更</th>
                    </tr>
                    <?php for($i=0; $i<$productCount; $i++): ?>
                    <tr>
                        <td><?= $rows[$i]['menu_name'] ?></a></td>
                        <td><?= $rows[$i]['menu_amount'] ?></td>
                        <td><?= $dispStatus[$i] ?></td>
                        <td>
                            <div class="admin-main-status">
                                <?php if($rows[$i]['ot_status'] == '1'): ?>
                                <a class="admin-main-status__button1" href="/store/order/detail.php?id=<?= $id ?>&mid=<?= $rows[$i]['menu_num'] ?>&changeStatus=2">提供済み</a>
                                <?php elseif($rows[$i]['ot_status'] == '2'): ?>
                                <a class="admin-main-status__button2" href="/store/order/detail.php?id=<?= $id ?>&mid=<?= $rows[$i]['menu_num'] ?>&changeStatus=1">未提供</a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endfor; ?>
                </table>
                <?php else: ?>
                    <p>注文データがありません。</p>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>
</html>
