<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = '決済情報入力';
$msg = '';

if(isset($_POST['btn'])){
    $_SESSION['order']['date'] = $_POST['date'];
    $_SESSION['order']['time'] = $_POST['time'];
    if(isset($_POST['mail'])){
        $_SESSION['order']['mail'] = $_POST['mail'];
    }
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>
    <main class="user-main">
        <form action="/user/order/insert.php" method="post">
        <div class="user-main-ticket-top">
            <h3 class="user-main-ticket-top__title">決済情報入力</h3>
            <?php if(isset($_SESSION['ticket'])): ?>
                <div class="user-main-ticket-top__total">支払い合計：
                    <span class="js-totalDue"><?= $_SESSION['total'] ?></span>
                円</div>
                <a class="user-main-ticket-top__reset" href="/user/order/">キャンセル</a>
                <input class="user-main-ticket-top__button" type="submit" name="btn" value="注文確定">
            <?php endif; ?>
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
            <section class="user-main-form__section">
                <h4 class="user-main-form__title">決済方法</h4>
                <label for="pay_local"><input id="pay_local" type="radio" name="pay" value="local" required>現地決済</label>
                <label for="pay_credit"><input id="pay_credit" class="js-pay" type="radio" name="pay" value="credit" required>クレジットカード決済</label>
            </section>
        </form>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
</body>
