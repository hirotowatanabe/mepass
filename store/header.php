<header class="admin-header">
    <ul class="admin-header__list">
        <li class="admin-header__item admin-header__item--title"><h1>mepass 店舗業務</h1></li>
        <li class="admin-header__item admin-header__item--page-title"><h2><?php print $pageTitle; ?></h2></li>
        <li class="admin-header__item admin-header__item--user"><i class="fa fa-caret-down" aria-hidden="true"></i>管理者：<?php print $comMemName; ?>
            <ul class="admin-header__sub-list">
                <li class="admin-header__sub-item"><a href="/store/account/logout/">ログアウト</a></li>
                <li class="admin-header__sub-item"><a href="/store/account/password_change/">パスワード変更</a></li>
            </ul>
        </li>
    </ul>
</header>
