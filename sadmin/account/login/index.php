<?php
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "システム管理者ログイン";
?>
<!DOCTYPE html>
<?php include("../../../head.php"); ?>
<body class="admin_login">
<div id="wrapper">
    <h1>MePass システム管理</h1>
    <div id="form">
        <h2>ログイン</h2>
        <form action="/sadmin/account/login/chk.php" method="post">
            <p>
                <h3>ID</h3>
                <input type="text" name="txtId" value="">
            </p>
            <p>
                <h3>パスワード</h3>
                <input type="password" name="txtPass" value="">
            </p>
            <p>
                <input type="submit" name="btn" value="ログイン">
            </p>
        </form>
    </div>
</div>
</body>
</html>
