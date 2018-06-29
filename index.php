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
<?php include($_SERVER['DOCUMENT_ROOT'].'/head.php'); ?>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>
    <main class="user-main">
        <div class="user-main-intro">
            <p class="user-main-intro__desc">
                注文はもっと簡単になる
            </p>
            <p class="user-main-intro__sub-desc">
                mepassならお気に入りの店舗はもちろん、初めて行く店舗でもスマートに注文が行えます。
                <a class="user-main-intro__link" href="user/about.php">詳しく知る</a>
            </p>
        </div>
        <div class="user-main__section user-main__section--p50 user-main__section--bg-orange">
            <h3 class="user-main__title user-main__title--fc-white">お店を探す</h3>
            <form class="user-main-search" action="/user/search.php#result" method="post">
                <section class="user-main-search__unit">
                    <h4 class="user-main-search__title">店舗名指定</h4>
                    <input class="user-main-search__input" type="text" name="name">
                </section>
                <section class="user-main-search__unit">
                    <h4 class="user-main-search__title">エリア指定</h4>
                    <ul class="user-main-search__list">
                        <li class="user-main-search__item">
                            <span>都道府県</span>
                            <input class="user-main-search__input user-main-search__input--small" type="text" name="pref">
                        </li>
                        <li class="user-main-search__item">
                            <span>市区町村</span>
                            <input class="user-main-search__input user-main-search__input--small" type="text" name="city">
                        </li>
                        <li class="user-main-search__item">
                            <span>番地以降</span>
                            <input class="user-main-search__input user-main-search__input--small" type="text" name="add">
                        </li>
                    </ul>
                </section>
                <input class="user-main-search__button" type="submit" name="searchSubmit" value="検索開始">
            </form>
        </div>
        <section class="user-main__section user-main__section--plr50">
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
        <section class="user-main__section user-main__section--plr50">
            <h2 class="user-main__title">更新情報</h2>
            <dl class="news-list">
                <dt class="news-list__unit">
                    <p class="news-list__title">サイトを一部リニューアルしました。</p>
                    <p class="news-list__date">2018.5.10</p>
                </dt>
                <dd class="news-list__content">主な変更点は次の通りです。トップページからもエリア検索が可能になりました。チケットの選択が詳細画面経由になりました。ログアウトがマイページ経由になりました。その他、細かい修正を行いました。</dd>
                <dt class="news-list__unit">
                    <p class="news-list__title">＜新機能＞店舗フォロー機能が追加されました。</p>
                    <p class="news-list__date">2018.3.8</p>
                </dt>
                <dd class="news-list__content">店舗ページにて店舗をフォローすることでフィード（トップページ）にてフォロー中の店舗として表示されるようになります。この機能は会員のみ有効です。店舗フォロー機能の追加に伴い、フィードではチケットが表示されなくなりました。</dd>
            </dl>
        </section>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php'); ?>
</body>
</html>
