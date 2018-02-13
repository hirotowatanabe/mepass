<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = 'チケットキャンセル確認';
$msg = $allCancel = $orderNum = $menuNum = '';

if($UserMail == ''){
    header('Location: /');
    exit();
}

if(isset($_GET['allCancel'])){
    $allCancel = $_GET['allCancel'];
    $orderNum = $_GET['orderNum'];
    if($allCancel == 'yes'){
        $msg = '注文番号'.$orderNum.'の注文を一括キャンセルします。よろしいですか？';
    }else if($allCancel == 'no'){
        $menuNum = $_GET['menuNum'];
        include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
        try{
            $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
            if($dbh == null){
                exit('DB接続失敗');
            }
            $dbh->query('set names utf8');
            $sql = " select * ";
            $sql .= " from t_menu ";
            $sql .= " where menu_num = ".$menuNum;
            $stmt = $dbh->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $stmt->rowCount();
        }catch(PDOException $e){
            echo 'Error:'.$e->getMessage();
            die();
        }
        $dbh = null;
        $msg = '注文番号'.$orderNum.'&nbsp;-&nbsp;'.$result['menu_name'].'の注文をキャンセルします。よろしいですか？';
    }
}else{
    header('Location: /user/account/mypage/');
    exit();
}

?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main user-mypage">
        <section class="user-mypage-section">
            <h2 class="user-mypage-section__title">注文キャンセルの確認</h2>
            <p class="user-mypage-section__description"><?= $msg ?></p>
            <div class="user-mypage-section__confirm">
                <a class="user-mypage-section__cancel" href="/user/account/mypage/ticket/detail.php?id=<?= $orderNum ?>">戻る</a>
                <a class="user-mypage-section__consent" href="/user/account/mypage/ticket/cancel_ex.php?allCancel=<?= $allCancel ?>&orderNum=<?= $orderNum ?>&menuNum=<?= $menuNum ?>">確認</a>
            </div>
        </section>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
</body>
</html>
