<?php
session_start();
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "プランの選択 | 加盟店契約お申込み";
if(isset($_SESSION["application"])){
    unset($_SESSION["application"]);
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body class="application">
    <?php include($_SERVER['DOCUMENT_ROOT']."/company/account/application/header.php"); ?>
    <main class="application_main">
        <form class="application_main_form" method="post" action="input_com_info.php">
            <p class="application_main_form_des">
                規模に応じて4つのプランからお選びください。<br>
                プランは毎月更新時に見直すことができます。<br>
                どのプランも最初の一ヶ月は無料です。
            </p>
            <table>
                <tr>
                    <th width="180"></th><th width="180">個人経営プラン</th><th width="180">小規模チェーン<br>プラン</th><th width="180">中規模チェーン<br>プラン</th><th width="180">大規模チェーン<br>プラン</th>
                </tr>
                <tr>
                    <th>登録可能店舗数</th><td>1店舗</td><td>10店舗</td><td>50店舗</td><td>無制限</td>
                </tr>
                <tr>
                    <th>登録可能従業員数</th><td>10名／店舗</td><td>50名／店舗</td><td>100名／店舗</td><td>無制限</td>
                </tr>
                <tr>
                    <th>利用料</th><td>5,000円／月</td><td>30,000円／月</td><td>50,000円／月</td><td>100,000円／月</td>
                </tr>
                <tr>
                    <th></th>
                    <td><label for="PlanNum0"><input id="PlanNum0" type="radio" name="PlanNum" value="0" required>このプランを選択</label></td>
                    <td><label for="PlanNum1"><input id="PlanNum1" type="radio" name="PlanNum" value="1">このプランを選択</label></td>
                    <td><label for="PlanNum2"><input id="PlanNum2" type="radio" name="PlanNum" value="2">このプランを選択</label></td>
                    <td><label for="PlanNum3"><input id="PlanNum3" type="radio" name="PlanNum" value="3">このプランを選択</label></td>
                </tr>
            </table>
            <p class="application_main_form_btn">
                <input type="submit" name="btn" value="次へ">
            </p>
        </form>
    </main>
</body>
</html>
