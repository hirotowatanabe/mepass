<header class="user-header">
    <nav>
        <ul class="user-header__list">
            <li class="user-header__item"><h1><a href="/">mepass</a></h1></li>
            <li class="user-header__item"><a href="#">お店を探す</a></li>
            <li class="user-header__item"><a href="/user/ticket.php">選択中のチケット</a></li>
            <li class="user-header__item">|</li>
            <?php if($UserMail == ''){ ?>
            <li class="user-header__item"><a href="/user/account/login/">ログイン</a></li>
            <li class="user-header__item"><a href="/user/account/create/">新規会員登録</a></li>
        <?php }else if($UserMail != ''){ ?>
            <li class="user-header__item"><?= $UserName ?>さん</li>
            <li class="user-header__item"><a href="/user/account/mypage/">マイページ</a></li>
            <li class="user-header__item"><a href="/user/account/logout/">ログアウト</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>
