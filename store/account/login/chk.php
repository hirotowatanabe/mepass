<?php
header("Content-Type:text/html; charset=UTF-8");

$Mail = "";
$Pass = "";

if(isset($_POST["btn"])){
    $num = $_POST["num"];
    $pass = $_POST["pass"];

    include($_SERVER['DOCUMENT_ROOT']."/mysqlenv.php");

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

    $SQL = "select * from t_company_member where com_mem_num='".$num."'";
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
        if($Row["com_mem_pass"]==$pass){
            session_start();
            $_SESSION["comMem"]["comMemNum"] = $Row["com_mem_num"];
            $_SESSION["comMem"]["comMemName"] = $Row["com_mem_name_kanji"];
            $_SESSION["comMem"]["store_num"] = $Row["store_num"];
            header("Location: /store/");
            exit();
        }else{
            header("Location: /store/account/login/?err=1");
            exit();
        }
    }else{
        header("Location: /store/account/login/?err=2");
        exit();
    }
}
?>
