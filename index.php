<?php
header('Content-Type:text/html; charset=UTF-8');
include($_SERVER['DOCUMENT_ROOT'].'/login_chk.php');
$pageTitle = 'フィード';

include($_SERVER['DOCUMENT_ROOT'].'/mysqlenv.php');
try{
    $dbh = new PDO($pdoDsn, $pdoUser, $pdoPass);
    if($dbh == null){
        exit('DB接続失敗');
    }
    $dbh->query('set names utf8');
    $sql = "select * from t_follow, t_store ";
    $sql .= " where t_follow.mem_mail = '".$UserMail."' ";
    $sql .= " and t_follow.store_num = t_store.store_num ";
    $stmt = $dbh->query($sql);
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $rows[] = $result;
    }
    $count = $stmt->rowCount();
}catch(PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}
$dbh = null;
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php") ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main class="user-main">
        <div class="user-main-intro">
            <p class="user-main-intro__desc">
                注文はもっと簡単になる
            </p>
            <p class="user-main-intro__sub-desc">
                mepassならお気に入りの店舗はもちろん、初めて行く店舗でもスマートに注文が行えます。
                <a class="user-main-intro__link" href="user/about.php">詳しく知る</a>
            </p>
            <form class="user-main-search" action="/user/search.php" method="post">
                <input class="user-main-search__text" type="text" name="name" placeholder="店舗名検索">
                <input class="user-main-search__submit" type="submit" name="searchSubmit" value="検索">
            </form>
        </div>
        <section class="user-main__section">
            <h2 class="user-main__title">フォロー中の店舗</h2>
            <?php if($count != 0): ?>
            <ul class="user-main__menu">
            <?php for($i=0; $i<$count; $i++): ?>
            <li class="store-card">
                <a class="store-card__name" href="/user/store.php?id=<?= $rows[$i]['store_num'] ?>"><?= $rows[$i]['store_name'] ?></h3></a>
            </li>
            <?php endfor; ?>
            </ul>
            <?php else: ?>
                <?php if($UserMail != ''): ?>
                <p class="user-main-msg">フォロー中の店舗はありません。</p>
                <?php else: ?>
                <p class="user-main-msg">フォロー中の店舗を確認するには<a class="user-main-msg__link" href="/user/account/login/">ログイン</a>してください。</p>
                <?php endif; ?>
            <?php endif; ?>
        </section>
        <section class="user-main__section">
            <h2 class="user-main__title">更新情報</h2>
            <p class="user-main-msg">2018.3.8 ＜新機能＞店舗フォロー機能が追加されました。店舗ページにて店舗をフォローすることでフィード（トップページ）にてフォロー中の店舗として表示されるようになります。この機能は会員のみ有効です。店舗フォロー機能の追加に伴い、フィードではチケットが表示されなくなりました。</p>
        </section>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT']."/footer.php") ?>
</body>
</html>
