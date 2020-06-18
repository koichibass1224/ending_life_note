<?php
//1. GETでidを取得
$id = $_GET["id"];

// DBに接続
require "functions.php";
$pdo = connectDB();

//3. データ削除SQLを準備
$delete = $pdo->prepare("DELETE FROM address WHERE id=:id");
$delete->bindvalue(":id",$id,PDO::PARAM_INT);

//4. SQL実行
$status = $delete->execute();

//5. 一覧ページへ戻す
if ($status == false) { 
    sql_error($delete);
  }else{
    header("Location: select_address.php");
  }

?>