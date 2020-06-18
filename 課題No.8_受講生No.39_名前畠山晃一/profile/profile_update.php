<?php

//1.POSTでデータを取得
$seinengappi = $_POST["seinengappi"];
$juusyo = $_POST["juusyo"];
$kakaritsuke = $_POST["kakaritsuke"];
//
$kaigo = $_POST["kaigo"];
$zouki = $_POST["zouki"];
$enmei = $_POST["enmei"];
$sougi = $_POST["sougi"];
$iei = $_POST["iei"];
$sougihiyou = $_POST["sougihiyou"];

$id = $_POST["id"];

//2.DB接続など
require "functions.php";
$pdo = connectDB();

//3.UPDATE 
$stmt = $pdo->prepare("UPDATE profile SET 
seinengappi=:seinengappi, 
juusyo=:juusyo, 
kakaritsuke=:kakaritsuke,
kaigo=:kaigo,
zouki=:zouki,
enmei=:enmei,
sougi=:sougi,
iei=:iei,
sougihiyou=:sougihiyou
 WHERE id=:id");

$stmt->bindValue(':seinengappi', $seinengappi, PDO::PARAM_STR);
$stmt->bindValue(':juusyo', $juusyo, PDO::PARAM_STR);
$stmt->bindValue(':kakaritsuke', $kakaritsuke, PDO::PARAM_STR);
//
$stmt->bindValue(':kaigo', $kaigo, PDO::PARAM_STR);
$stmt->bindValue(':zouki', $zouki, PDO::PARAM_STR);
$stmt->bindValue(':enmei', $enmei, PDO::PARAM_STR);
$stmt->bindValue(':sougi', $sougi, PDO::PARAM_STR);
$stmt->bindValue(':iei', $iei, PDO::PARAM_STR);
$stmt->bindValue(':sougihiyou', $sougihiyou, PDO::PARAM_STR);

$stmt->bindValue(':id',$id , PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false) {
  //SQLエラー関数
  sql_error($stmt);
}else{
 header("Location: select_profile.php");
}
?>