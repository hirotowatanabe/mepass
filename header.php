<header class="user-header">
    <nav class="user-header__nav">
        <ul class="user-header__list">
            <li class="user-header__item">
                <h1 class="user-header__title">
                    <a class="user-header__link user-header__link--title" href="/">mepass</a>
                </h1>
            </li>
            <li class="user-header__item">
                <a class="user-header__link" href="/user/search.php">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <span class="user-header__text">店舗検索</span>
                </a>
            </li>
            <li class="user-header__item">
                <a class="user-header__link" href="/user/ticket.php">
                    <i class="fa fa-ticket" aria-hidden="true"></i>
                    <span class="user-header__text">選択中のチケット</span>
                </a>
            </li>
            <li class="user-header__item">
                <?php if($UserMail == ''): ?>
                <a class="user-header__link" href="/user/account/login/">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    ログイン
                </a>
                <?php elseif($UserMail != ''): ?>
                <a class="user-header__link" href="/user/account/mypage/">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <?= htmlspecialchars($UserName) ?>さん
                </a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
</header>
