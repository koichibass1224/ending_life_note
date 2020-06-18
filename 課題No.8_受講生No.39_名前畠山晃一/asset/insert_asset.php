<?php
//1. POSTデータ取得
$bank = $_POST["bank"];
$stock = $_POST["stock"];
$insurance = $_POST["insurance"];
$estate = $_POST["estate"];

//2. DB接続します
require "functions.php";
$pdo = connectDB();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO asset(id,bank,stock,insurance,estate,indate)VALUES(NULL,:bank,:stock,:insurance,:estate,sysdate())");
$stmt->bindValue(':bank', $bank, PDO::PARAM_STR);
$stmt->bindValue(':stock', $stock, PDO::PARAM_STR);
$stmt->bindValue(':insurance', $insurance, PDO::PARAM_STR);
$stmt->bindValue(':estate', $estate, PDO::PARAM_STR); 
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{

//５．index.phpへリダイレクト
  header("Location: select_asset.php");
}
?>
