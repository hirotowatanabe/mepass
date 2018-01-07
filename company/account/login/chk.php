<?php
header("Content-Type:text/html; charset=UTF-8");

$Mail = "";
$Pass = "";

if(isset($_POST["btn"])){
    $num = $_POST["num"];
    $pass = $_POST["pass"];
    $ReUrl = $_POST["ReUrl"];

    include("../../../mysqlenv.php");

    if(!$Link = mysqli_connect($HOST,$USER,$PASS)){
        exit("MySQL接続エラー<br />" . mysqli_connect_error());
    }

    $SQL = "set names utf8";
    if(!mysqli_query($Link,$SQL)){
        exit("MySQLクエリー送信エラー<br />" . $SQL);
    }

    if(!mysqli_select_db($Link,$DB)){
        exit("MySQLデータベース選択エラー<br />" . $DB);
    }

    $SQL = "select * from t_company where com_num='".$num."'";
    if(!$SqlRes = mysqli_query($Link,$SQL)){
        exit("MySQLクエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL);
    }

    //  連想配列への抜出（先頭行）
    $Row = mysqli_fetch_array($SqlRes);

    //  抜き出されたレコード件数を求める
    $NumRow = mysqli_num_rows($SqlRes);

    //  MySQLのメモリ解放(selectの時のみ)
    mysqli_free_result($SqlRes);

    if(!mysqli_close($Link)){
        exit("MySQL切断エラー");
    }

    if($NumRow != 0){
        if($Row["com_pass"]==$pass){
            session_start();
            $_SESSION["company"]["comNum"] = $Row["com_num"];
            $_SESSION["company"]["comName"] = $Row["com_name"];
            header("Location: /company/");
            exit();
        }else{
            header("Location: /company/account/login/?err=1");
            exit();
        }
    }else{
        header("Location: /company/account/login/?err=2");
        exit();
    }
}
?>
