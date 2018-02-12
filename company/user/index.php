<?php
include($_SERVER['DOCUMENT_ROOT'].'/company/login_chk.php');
header('Content-Type:text/html; charset=UTF-8');
$pageTitle = 'ユーザ情報管理';
$searchValue = '';

if(isset($_POST['btn'])){
    $searchValue = $_POST['userSearch'];
}
include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = " select * from t_company_member, t_store ";
    $sql .= " where com_mem_name_kanji LIKE '%".$searchValue."%' ";
    $sql .= " and t_company_member.com_id = '".$comId."' ";
    $sql .= " and t_company_member.store_num = t_store.store_num ";
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
    <?php include($_SERVER['DOCUMENT_ROOT'].'/company/header.php'); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/company/gnav.php'); ?>
        <main class="admin-main">
            <div class="admin-main-top">
                <form action="index.php" method="post">
                    <input class="admin-main-top-form__text" type="text" name="userSearch" value="<?= $searchValue ?>" placeholder="ユーザ名検索" />
                    <input class="admin-main-top-form__submit" type="submit" name="btn" value="検索" />
                </form>
                <a class="admin-main-top__button" href="/company/user/create/">新規ユーザ登録</a>
            </div>
            <?php if($count != 0): ?>
            <table>
                <tr>
                    <th>ユーザ名</th><th>所属店舗</th>
                </tr>
                <?php for($i=0; $i<$count; $i++): ?>
                <tr>
                    <td><a href="/company/user/detail.php?num=<?= $rows[$i]['com_mem_num'] ?>"><?= $rows[$i]['com_mem_name_kanji'] ?></a></td><td><?= $rows[$i]['store_name'] ?></td>
                </tr>
                <?php endfor; ?>
            </table>
            <?php else: ?>
                <p>該当ユーザは存在しません。</p>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
