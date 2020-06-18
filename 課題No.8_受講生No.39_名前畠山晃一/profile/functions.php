<?php
// データベースに接続
function connectDB() {

        try {
          //Password:MAMP='root',XAMPP=''
          return new PDO('mysql:dbname=end_db;charset=utf8;host=localhost','root','root');
        } catch (PDOException $e) {
          exit('DBConnectError:'.$e->getMessage());
        }     
      }
?>
