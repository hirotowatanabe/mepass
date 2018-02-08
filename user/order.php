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
                <div class="user-main-form__item">
                    <input class="user-main-form__text" type="date" name="date" value="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="user-main-form__item">
                    <input class="user-main-form__text" type="time" name="time" value="<?= date('H:i') ?>" required>
                </div>

            </section>
            <?php if($UserMail == ''): ?>
                <section class="user-main-form__section">
                    <h4 class="user-main-form__title">メールアドレス<br>(会員の方は入力不要です。上部のメニューよりログインして下さい。)</h4>
                    <input class="user-main-form__text" type="text" name="mail" required>
                </section>
            <?php endif; ?>
        </form>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
