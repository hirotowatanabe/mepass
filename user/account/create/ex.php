<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$mail = '';
$pass = '';
$name = '';
$reUrl = '';
$pageTitle = 'ユーザ登録';

if(isset($_POST['btn'])){
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $reUrl = $_POST['reUrl'];
    include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
    try{
        $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
        if($dbh == null){
            exit('DB接続失敗');
        }
        $dbh->query('set names utf8');
        $chkSql = " select * from t_member where mem_mail = '".$mail."'";
        $stmt = $dbh->query($chkSql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        //重複アドレス検知
        if($count != 0){
            header('Location: /user/account/create/?err=1');
            exit();
        }
        $sql = "insert into t_member values('".$mail."', '".$pass."', '".$name."')";
        $stmt = $dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
    }catch(PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
    $dbh = null;

    $_SESSION['user']['userMail'] = $mail;
    $_SESSION["user"]['userName'] = $name;
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>
    <main class="user-main user-account">
        <h1 class="user-account__title">アカウントの作成が完了しました。</h1>
        <p class="user-account__link">
            <a href="/">トップページ</a>
        </p>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
</body>
</html>
