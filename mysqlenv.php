<?php
if($_SERVER['HTTP_HOST'] == 'mepasslocal:1024'){
    //ローカルDB接続情報
    $pdoDsn = 'mysql:dbname=mepass;host=localhost';
    $pdoUser = 'root';
    $pdoPass = 'root';

    $HOST = "localhost";
    $USER = "root";
    $PASS = "root";
    $DB = "mepass";
}else{
    //リモートDB接続情報
    $pdoDsn = 'mysql:dbname=mepass_db;host=mysql621.db.sakura.ne.jp';
    $pdoUser = 'mepass';
    $pdoPass = 'db_admin';

    $HOST = "mysql621.db.sakura.ne.jp";
    $USER = "mepass";
    $PASS = "db_admin";
    $DB = "mepass_db";
}
?>
