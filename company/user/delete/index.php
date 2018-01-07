<?php
include($_SERVER['DOCUMENT_ROOT']."/company/login_chk.php");
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "ユーザ情報管理／ユーザ情報削除／削除確認";
$comMemNum = "";

if(isset($_GET["num"])){
    $comMemNum = $_GET["num"];
    $_SESSION["comMemCreate"]["comMemNum"] = $comMemNum;
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/company/header.php"); ?>
    <div class="admin-content">
        <?php include($_SERVER['DOCUMENT_ROOT']."/company/gnav.php"); ?>
        <main class="admin-main">
            <p>ユーザ情報削除確認</p>
            <a href="/company/user/delete/ex.php">削除実行</a>
            <a href="/company/user/detail.php?num=<?php print $comMemNum; ?>">キャンセル</a>
        </main>
    </div>
</body>
</html>
