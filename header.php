<header class="user-header">
    <nav class="user-header__nav">
        <h1 class="user-header__title"><a href="/">mepass</a></h1>
        <ul class="user-header__list">
            <li class="user-header__item"><a href="/user/search.php"><i class="fa fa-search" aria-hidden="true"></i><span class="user-header__search-text">店舗検索</span></a></li>
            <li class="user-header__item"><a href="/user/ticket.php">選択中のチケット</a></li>
            <?php if($UserMail == ''): ?>
            <li class="user-header__item"><a href="/user/account/login/">ログイン</a></li>
            <li class="user-header__item"><a href="/user/account/create/">ユーザ登録</a></li>
            <?php elseif($UserMail != ''): ?>
            <li class="user-header__item"><span class="user-header__name"><?= $UserName ?>さん</span><a href="/user/account/mypage/">マイページ</a>&nbsp;<a href="/user/account/logout/">ログアウト</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
