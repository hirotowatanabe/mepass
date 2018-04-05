<?php
header('Content-Type:text/html; charset=UTF-8');
//ログイン必須
$loginRequired = 'true';
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = '来店予定日時入力';
$msg = '';

//チケットセッションが存在しない場合は強制リダイレクト
if(!isset($_SESSION['ticket'])){
    header('Location: /user/ticket.php');
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>
    <main class="user-main">
        <form action="/user/order/pay.php" method="post">
        <div class="user-main-ticket-top">
            <h3 class="user-main-ticket-top__title">来店予定日時入力</h3>
                <div class="user-main-ticket-top__total">支払い合計：
                    <span class="js-totalDue"><?= $_SESSION['total'] ?></span>
                円</div>
                <a class="user-main-ticket-top__reset" href="/user/ticket.php">キャンセル</a>
                <input class="user-main-ticket-top__button" type="submit" name="btn" value="決済に進む">
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
            <section class="user-main-form__section">
                <h4 class="user-main-form__title">来店予定日時</h4>
                <div class="user-main-form__item">
                    <input class="user-main-form__text" type="date" name="date" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="user-main-form__item">
                    <input class="user-main-form__text" type="time" name="time" value="<?= date('H:i') ?>" required>
                </div>
            </section>
        </form>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
</body>
