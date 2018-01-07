<?php
/*-----------------------------------------------------------------------------
  概要      :
            :
  作成者    :
  作成日    :
  更新履歴  :
-----------------------------------------------------------------------------*/
//  HTTPヘッダーで文字コードを指定
header("Content-Type:text/html; charset=UTF-8");
//処理部
include("login_chk.php");
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
<link rel="stylesheet" href="/css/style.css" type="text/css" />
<title>トップ | mepass</title>
</head>
<body>
<div id="wrapper">
    <?php include("header.php") ?>
    <div id="main">

        まだお店をフォローしていません。こちらから探しましょう。
    </div>
    <?php include("footer.php") ?>
</div>
<?php
//表示部
?>
</body>
</html>
