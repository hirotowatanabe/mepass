<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = '注文';
$msg = '';
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main">
        <form action="order_ex.php" method="post">
        <div class="user-main-ticket-top">
            <h3 class="user-main-ticket-top__title">注文オプション</h3>
            <?php if(isset($_SESSION["ticket"])): ?>
                <div class="user-main-ticket-top__total">支払い合計：<?= $_SESSION['total'] ?>円</div>
                <a class="user-main-ticket-top__reset" href="ticket.php">キャンセル</a>
                <input class="user-main-ticket-top__button" type="submit" name="btn" value="注文確定">
            <?php endif; ?>
        </div>
        <?php if($msg != ''): ?>
        <p class="user-main-msg"><?= $msg ?></p>
        <?php endif; ?>
            <section class="user-main-form__section">
                <h4 class="user-main-form__title">決済方法</h4>
                <label><input type="radio" name="pay" value="local" required>現地決済</label>
            </section>
            <section class="user-main-form__section">
                <h4 class="user-main-form__title">来店予定日時</h4>
                <input class="user-main-form__text" type="date" name="date" required>
                <input class="user-main-form__text" type="time" name="time" required>
            </section>
            <?php if($UserMail == ''): ?>
                <section class="user-main-form__section">
                    <h4 class="user-main-form__title">メールアドレス</h4>
                    <input type="text" name="mail">
                </section>
            <?php endif; ?>
        </form>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
