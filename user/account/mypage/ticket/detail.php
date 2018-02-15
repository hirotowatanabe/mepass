<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = 'チケット詳細';

$allCanceledFlag = '';

if($UserMail == ''){
    header('Location: /');
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('Location: /user/account/mypage/');
    exit();
}

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " select * from t_order, t_order_ticket, t_menu, t_store ";
    $sql .= " where t_order.order_num = ".$id;
    $sql .= " and t_order.order_num = t_order_ticket.order_num ";
    $sql .= " and t_menu.menu_num = t_order_ticket.menu_num ";
    $sql .= " and t_menu.store_num = t_store.store_num ";
    $stmt = $dbh->query($sql);
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $rows[] = $result;
        if($result['ot_status'] == '1'){
            $dispStatus[] = '未提供';
            //一点でも未提供商品がある場合、Flagにnoを格納し、一括キャンセルボタンを表示する
            $allCanceledFlag = 'no';
        }else if($result['ot_status'] == '2'){
            $dispStatus[] = '提供済み';
        }else if($result['ot_status'] == '3'){
            $dispStatus[] = 'キャンセル済み';
        }
        if($result['order_pay'] == 'local'){
            $dispPay[] = '現地決済';
        }
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
            <h2 class="user-mypage-section__title">注文基本情報</h2>
            <?php if($count != 0): ?>
            <table>
                <tr><th>注文番号</th><th>来店予定日時</th><th>店舗名</th><th>決済方法</th></tr>
                <?php for($i=0; $i<1; $i++): ?>
                <?php $dt = strtotime($rows[$i]['order_datetime']); ?>
                <tr>
                    <td><?= $rows[$i]['order_num'] ?></td>
                    <td><?= date('Y-m-d H:i', $dt) ?></td>
                    <td><?= $rows[$i]['store_name'] ?></td>
                    <td><?= $dispPay[$i] ?></td>
                </tr>
                <?php endfor; ?>
            </table>
            <?php else: ?>
                該当データがありません。
            <?php endif; ?>
        </section>
        <section class="user-mypage-section">
            <h2 class="user-mypage-section__title">提供商品情報</h2>
            <?php if($count != 0): ?>
            <table>
                <tr>
                    <th>提供商品</th><th>数量</th><th>ステータス</th><th>キャンセル</th>
                </tr>
                <?php for($i=0; $i<$count; $i++): ?>
                <tr>
                    <td><?= $rows[$i]['menu_name'] ?></a></td>
                    <td><?= $rows[$i]['menu_amount'] ?></td>
                    <td><?= $dispStatus[$i] ?></td>
                    <td>
                        <?php if($rows[$i]['ot_status'] == '1'): ?>
                        <a class="user-mypage-section__cancel user-mypage-section__cancel--one" href="/user/account/mypage/ticket/cancel.php?allCancel=no&orderNum=<?= $id ?>&menuNum=<?= $rows[$i]['menu_num'] ?>">キャンセル</a>
                        <?php elseif($rows[$i]['ot_status'] == '3'): ?>
                        既にキャンセル済みです。
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endfor; ?>
            </table>
            <?php else: ?>
                <p>該当データがありません。</p>
            <?php endif; ?>
        </section>
        <?php if($allCanceledFlag == 'no'): ?>
        <section class="user-mypage-section">
            <a class="user-mypage-section__cancel" href="/user/account/mypage/ticket/cancel.php?allCancel=yes&orderNum=<?= $id ?>">一括キャンセル</a>
        </section>
        <?php endif; ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
</body>
</html>
