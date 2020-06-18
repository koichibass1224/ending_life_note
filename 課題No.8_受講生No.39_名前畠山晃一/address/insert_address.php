<?php
//1. POSTデータ取得
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$relation = $_POST["relation"];

//2. DB接続します
require "functions.php";
$pdo = connectDB();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO address(id,name,email,phone,relation,indate)VALUES(NULL,:name,:email,:phone,:relation,sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
$stmt->bindValue(':relation', $relation, PDO::PARAM_STR); 
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{

//５．index.phpへリダイレクト
  header("Location: select_address.php");
}
?>
