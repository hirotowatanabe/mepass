<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = '注文完了';
$id = '';

//注文番号取得
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>
    <main class="user-main">
        <div class="user-main-ticket-top">
            <h3 class="user-main-ticket-top__title">注文が完了しました。</h3>
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
        <section class="user-main-form__section">
            <h4 class="user-main-form__title">注文番号</h4>
            <?= $id ?>
        </section>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
</body>
