<?php
header("Content-Type:text/html; charset=UTF-8");

$id = "";
$pass = "";

if(isset($_POST["btn"])){
    $id = $_POST["txtId"];
    $pass = $_POST["txtPass"];

    include("../../../mysqlenv.php");

    //  MySQLとの接続開始
    if(!$Link = mysqli_connect($HOST,$USER,$PASS)){
      //  うまく接続できなかった
      exit("MySQL接続エラー<br />" . mysqli_connect_error());
    }

    //  クエリー送信(文字コード)
    $SQL = "set names utf8";
    if(!mysqli_query($Link,$SQL)){
      //  クエリー送信失敗
      exit("MySQLクエリー送信エラー<br />" . $SQL);
    }

    //  MySQLデータベース選択
    if(!mysqli_select_db($Link,$DB)){
      //  MySQLデータベース選択失敗
      exit("MySQLデータベース選択エラー<br />" . $DB);
    }

    //  クエリー送信(選択クエリー)
    $SQL = "select * from t_sadmin where sadmin_id='".$id."'";
    if(!$SqlRes = mysqli_query($Link,$SQL)){
      //  クエリー送信失敗
      exit("MySQLクエリー送信エラー<br />" .
            mysqli_error($Link) . "<br />" . $SQL);
    }

    //  連想配列への抜出（先頭行）
    $Row = mysqli_fetch_array($SqlRes);

    //  抜き出されたレコード件数を求める
    $NumRow = mysqli_num_rows($SqlRes);

    //  MySQLのメモリ解放(selectの時のみ)
    mysqli_free_result($SqlRes);

    //  MySQLとの切断
    if(!mysqli_close($Link)){
      exit("MySQL切断エラー");
    }

    if($NumRow != 0){
        if($Row["sadmin_pass"]==$pass){
            session_start();
            $_SESSION["sadminId"] = $Row["sadmin_id"];
            header("Location: /sadmin/");
            exit();
        }else{
            $ErrMsg = "組み合わせが誤っています";
            header("Location: index.php?ErrMsg=".$ErrMsg);
            exit();
        }
    }else{
        $ErrMsg = "入力されたIDは登録されていません";
        header("Location: index.php?ErrMsg=".$ErrMsg);
        exit();
    }
}
?>
