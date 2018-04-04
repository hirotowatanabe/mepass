<header class="admin_header">
    <div class="flex_area">
        <h1>mepass system admin</h1>
        <h2><?php print $pageTitle; ?></h2>
        <p class="user_info"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i>管理者ID：<?php print $sadminId; ?></p>
    </div>
    <ul class="admin_header_subnav">
        <li><a href="/sadmin/account/logout/index.php">ログアウト</a></li>
        <li><a href="/sadmin/account/password_change/index.php">パスワード変更</a></li>
    </ul>
</header>
<nav class="left_menu_gnav">
    <ul class="left_menu_ul">
        <li><a href="/sadmin/index.php"><i class="fa fa-tachometer" aria-hidden="true"></i>ダッシュボード</a></li>
        <li><a href="/sadmin/enduser/index.php"><i class="fa fa-address-book" aria-hidden="true"></i>エンドユーザ管理</a></li>
        <li><a href="/sadmin/client/index.php"><i class="fa fa-users" aria-hidden="true"></i>クライアント管理</a></li>
        <li><a href="/sadmin/setting/index.php"><i class="fa fa-cogs" aria-hidden="true"></i>設定</a></li>
    </ul>
</nav>
