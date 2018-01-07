<header class="user_header">
    <h1>mepass</h1>
    <nav>
        <ul>
            <li><a href="#">お店を探す</a></li>
            <li><a href="#">選択中のチケット</a></li>
            <li>|</li>
            <?php if($UserMail == ""){ ?>
            <li><a href="/user/account/login/">ログイン</a></li>
            <li><a href="/user/account/create/">新規会員登録</a></li>
            <?php }else if($UserMail != ""){ ?>
            <li><?php print $UserName; ?>さん</li>
            <li><a href="/user/account/mypage/">マイページ</a></li>
            <li><a href="/user/account/logout/">ログアウト</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>
