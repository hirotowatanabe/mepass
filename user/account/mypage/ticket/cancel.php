<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = 'チケットキャンセル確認';

if($UserMail == ''){
    header('Location: /');
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('Location: /user/account/mypage/');
    exit();
}

?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main user-mypage">
        <section class="user-mypage-section">
            <h2 class="user-mypage-section__title">注文キャンセルの確認</h2>
            <p class="user-mypage-section__description">注文番号<?= $id ?>の注文をキャンセルします。よろしいですか？</p>
            <div class="user-mypage-section__confirm">
                <a class="user-mypage-section__cancel" href="/user/account/mypage/ticket/detail.php?id=<?= $id ?>">戻る</a>
                <a class="user-mypage-section__consent" href="/user/account/mypage/ticket/cancel_ex.php?id=<?= $id ?>">確認</a>
            </div>
        </section>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
</html>
