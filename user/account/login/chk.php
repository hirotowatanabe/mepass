<?php
header("Content-Type:text/html; charset=UTF-8");
//処理部

$Mail = "";
$Pass = "";
$ReUrl = "";

if(isset($_POST["btn"])){
    $Mail = $_POST["Mail"];
    $Pass = $_POST["Pass"];
    $ReUrl = $_POST["ReUrl"];
    /*
    if($ReUrl == ""){
        $ReUrl = "/index.php";
    }
    */

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

    $SQL = "select * from t_member where mem_mail='".$Mail."'";
    if(!$SqlRes = mysqli_query($Link,$SQL)){
        exit("MySQLクエリー送信エラー<br />" . mysqli_error($Link) . "<br />" . $SQL);
    }

    $Row = mysqli_fetch_array($SqlRes);

    $NumRow = mysqli_num_rows($SqlRes);

    mysqli_free_result($SqlRes);

    if(!mysqli_close($Link)){
        exit("MySQL切断エラー");
    }

    if($NumRow != 0){
        if($Row["mem_pass"]==$Pass){
            session_start();
            $_SESSION["user"]["userMail"] = $Row["mem_mail"];
            $_SESSION["user"]["userName"] = $Row["mem_name_kanji"];
            header("Location: ".$ReUrl);
            exit();
        }else{
            header("Location: /user/account/login/?err=1&ReUrl=".$ReUrl);
            exit();
        }
    }else{
        header("Location: /user/account/login/?err=2&ReUrl=".$ReUrl);
        exit();
    }
}
?>
