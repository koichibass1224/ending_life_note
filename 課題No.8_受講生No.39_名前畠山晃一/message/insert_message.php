<?php
//1. POSTデータ取得
$who = $_POST["who"];
$message = $_POST["message"];
$sign = $_POST["sign"];

//2. DB接続します
require "functions.php";
$pdo = connectDB();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO message(id,
who,
message,
sign,indate)VALUES(NULL,
:who,
:message,
:sign,sysdate())");
$stmt->bindValue(':who', $who, PDO::PARAM_STR);
$stmt->bindValue(':message', $message, PDO::PARAM_STR);
$stmt->bindValue(':sign', $sign, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{

//５．index.phpへリダイレクト
  header("Location: select_message.php");
}
?>
