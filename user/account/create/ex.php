<?php
header('Content-Type:text/html; charset=UTF-8');
$mail = '';
$pass = '';
$name = '';
$reUrl = '';

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
        $sql = "insert into t_member values('".$mail."', '".$pass."', '".$name."')";
        $stmt = $dbh->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
    }catch(PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
    $dbh = null;

    session_start();
    $_SESSION['user']['userMail'] = $mail;
    $_SESSION["user"]['userName'] = $name;
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body class="login">
    <h1 class="login__title">アカウントの作成が完了しました。</h1>
    <p class="login__link">
        <a href="/">トップページ</a>
    </p>
</body>
</html>