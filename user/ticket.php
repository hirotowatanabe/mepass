<?php
header("Content-Type:text/html; charset=UTF-8");
include($_SERVER['DOCUMENT_ROOT']."/login_chk.php");
$pageTitle = "選択中のチケット";
if(isset($_POST["menuSelectSubmit"])){
    $_SESSION["ticket"] = array(
        'id' => $_POST["id"],
        'num' => $_POST["num"]
    );
    header("Location: /");
    exit();
}

/*
if(isset($_SESSION)){
    foreach($_SESSION as $name => $value){
        $id[] = $name;
        $num[] = $value;
    }
}
*/
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main">
        <?php if(isset($_SESSION["ticket"])): ?>
            <?php for($i = 0;$i < count($id);$i++){ ?>
            <!--display ticket-->
            <?php } ?>
        <?php else: ?>
            選択中のチケットはありません。
        <?php endif; ?>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
