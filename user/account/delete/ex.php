<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = 'アカウント削除完了';

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = "delete from t_member where mem_mail = '".$UserMail."'";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;

unset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="ja">
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php"); ?>
    <main class="user-main user-account">
        <h1 class="user-account__title">アカウントの削除が完了しました。</h1>
        <p class="user-account__link">
            <a href="/">トップページ</a>
        </p>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php"); ?>
</body>
</html>
