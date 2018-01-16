<?php
include($_SERVER['DOCUMENT_ROOT']."/store/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "注文管理";
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
    $sql = " select * from t_order, t_order_ticket, t_menu, t_member ";
    $sql .= " where t_order.order_num = ".$id;
    $sql .= " and t_order.order_num = t_order_ticket.order_num ";
    $sql .= " and t_menu.menu_num = t_order_ticket.menu_num ";
    $sql .= " and t_order.mem_mail = t_member.mem_mail ";
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
    <?php include($_SERVER['DOCUMENT_ROOT']."/store/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/store/gnav.php"); ?>
        <main class="admin-main">
            <section class="admin-main-section">
                <h3 class="admin-main__title">お客様基本情報</h3>
                <?php if($count != 0): ?>
                <table>
                    <tr>
                        <th>注文番号</th><th>お客様名</th><th>決済方法</th><th>来店予定日時</th>
                    </tr>
                    <?php for($i=0; $i<1; $i++): ?>
                    <tr>
                        <td><?= $rows[$i]['order_num'] ?></td>
                        <td><?= $rows[$i]['mem_name'] ?>様</td>
                        <td><?= $rows[$i]['order_pay'] ?></td>
                        <td><?= $rows[$i]['order_datetime'] ?></td>
                    </tr>
                    <?php endfor; ?>
                </table>
                <?php else: ?>
                    <p>注文データがありません。</p>
                <?php endif; ?>
            </section>

            <section class="admin-main-section">
                <h3 class="admin-main__title">提供商品情報</h3>
                <?php if($count != 0): ?>
                <table>
                    <tr>
                        <th>提供商品</th><th>数量</th><th>ステータス</th>
                    </tr>
                    <?php for($i=0; $i<$count; $i++): ?>
                    <tr>
                        <td><?= $rows[$i]['menu_name'] ?></a></td>
                        <td><?= $rows[$i]['menu_amount'] ?></td>
                        <td><?= '未提供' ?></td>
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
