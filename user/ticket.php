<?php
header("Content-Type:text/html; charset=UTF-8");
include($_SERVER['DOCUMENT_ROOT']."/login_chk.php");
$pageTitle = "選択中のチケット";
if(isset($_POST["menuSelectSubmit"])){
    $menuArray = array(
        $_POST["id"] => $_POST["num"]
    );
    $_SESSION["ticket"][] = $menuArray;
    header("Location: /");
    exit();
}

if(isset($_GET["reset"])){
    session_unset($_SESSION["ticket"]);
}
if(isset($_SESSION["ticket"])){
    print_r($_SESSION["ticket"]);
    /*
    foreach($_SESSION as $name => $value){
        $id[] = $name;
        $num[] = $value;
    }
    */
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main">
        <?php if(isset($_SESSION["ticket"])): ?>
            <?php //for($i = 0;$i < count($id);$i++){ ?>
            <!--display ticket-->
            <?php //} ?>
            <a href="ticket.php?reset=true">選択中のチケットをリセット</a>
        <?php else: ?>
            選択中のチケットはありません。
        <?php endif; ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
