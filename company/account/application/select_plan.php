<?php
session_start();
header("Content-Type:text/html; charset=UTF-8");
$pageTitle = "プランの選択 | 加盟店契約お申込み";
$planNum = "";
if(isset($_SESSION["application"]["planNum"])){
    $planNum = $_SESSION["application"]["planNum"];
}
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT']."/head.php"); ?>
<body class="application">
    <?php include($_SERVER['DOCUMENT_ROOT']."/company/account/application/header.php"); ?>
    <main class="application-main">
        <form class="application-main-form" method="post" action="input_com_info.php">
            <p class="application-main-form__description">
                規模に応じて4つのプランからお選びください。
            </p>
            <table>
                <tr>
                    <th></th><th>個人経営プラン</th><th>小規模チェーンプラン</th><th>中規模チェーンプラン</th><th>大規模チェーンプラン</th>
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
                    <td><label for="planNum0"><input id="planNum0" type="radio" name="planNum" value="0" <?php if($planNum == "0"){ print "checked"; } ?> required>このプランを選択</label></td>
                    <td><label for="planNum1"><input id="planNum1" type="radio" name="planNum" value="1" <?php if($planNum == "1"){ print "checked"; } ?>>このプランを選択</label></td>
                    <td><label for="planNum2"><input id="planNum2" type="radio" name="planNum" value="2" <?php if($planNum == "2"){ print "checked"; } ?>>このプランを選択</label></td>
                    <td><label for="planNum3"><input id="planNum3" type="radio" name="planNum" value="3" <?php if($planNum == "3"){ print "checked"; } ?>>このプランを選択</label></td>
                </tr>
            </table>
            <input class="application-main-form__submit" type="submit" name="btn" value="次へ">
        </form>
    </main>
</body>
</html>
