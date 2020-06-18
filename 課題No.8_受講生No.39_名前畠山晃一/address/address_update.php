<?php
//1.POSTでデータを取得
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$relation = $_POST["relation"];
$id = $_POST["id"];

//2.DB接続など
require "functions.php";
$pdo = connectDB();

//3.UPDATE 
$stmt = $pdo->prepare("UPDATE address SET name=:name, email=:email, phone=:phone, relation=:relation WHERE id=:id");

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
$stmt->bindValue(':relation',$relation , PDO::PARAM_STR);
$stmt->bindValue(':id',$id , PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false) {
  //SQLエラー関数
  sql_error($stmt);
}else{
 header("Location: select_address.php");
}
?>