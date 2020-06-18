<?php
//1. POSTデータ取得
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

//2. DB接続します
require "functions.php";
$pdo = connectDB();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO profile(id,
seinengappi,
juusyo,
kakaritsuke,

kaigo,
zouki,
enmei,
sougi,
iei,
sougihiyou,
indate
)VALUES(NULL,
:seinengappi,
:juusyo,
:kakaritsuke,

:kaigo,
:zouki,
:enmei,
:sougi,
:iei,
:sougihiyou,
sysdate())");

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
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{

//５．index.phpへリダイレクト
  header("Location: select_profile.php");
}

//}
