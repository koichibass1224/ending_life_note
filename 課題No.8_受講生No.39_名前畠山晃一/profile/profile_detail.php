<?php
// GETでidを取得
$id = $_GET["id"];

// DBに接続
require "functions.php";
$pdo = connectDB();

// 対象データ取得
$stmt = $pdo->prepare("SELECT * FROM profile WHERE id=:id");
$stmt ->bindvalue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

//結果をfetch()
if ($status == false) { 
  sql_error($stmt);
}else{
  $row = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>profile_detail</title>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<!--profile select/input-->
<div class="container profile">
  <div class="row">
    <div class="inbox col-md-12">

        <h1>個人情報について</h1>
          <form action="profile_update.php" method="post" >
          <p>生年月日</p>
          <td><textarea name="seinengappi" id="" cols="100%" rows="2"><?=$row['seinengappi']?></textarea></td>
    
          <p>住所</p>
          <textarea name="juusyo" id="" cols="100%" rows="2"><?=$row['juusyo']?></textarea>

          <p>かかりつけの病院・常備薬・持病など</p>
          <textarea name="kakaritsuke" id="" cols="100%" rows="2"><?=$row['kakaritsuke']?></textarea>

        <h1>葬儀について</h1>
          <p>介護が必要となった際（認知症など）の方針</p>
          <textarea name="kaigo" id="" cols="100%" rows="2"><?=$row['kaigo']?></textarea>
          <p>臓器提供の方針</p>
          <textarea name="zouki" id="" cols="100%" rows="2"><?=$row['zouki']?></textarea>
          <p>終末期医療（延命措置など）の方針</p>
          <textarea name="enmei" id="" cols="100%" rows="2"><?=$row['enmei']?></textarea>
          <p>葬儀・埋葬（納骨・墓）の方法</p>
          <textarea name="sougi" id="" cols="100%" rows="2"><?=$row['sougi']?></textarea>
          <p>遺影の有無</p>
          <textarea name="iei" id="" cols="100%" rows="2"><?=$row['iei']?></textarea>
          <p>葬式費用の負担について</p>
          <textarea name="sougihiyou" id="" cols="100%" rows="2"><?=$row['sougihiyou']?></textarea>


          <input type="hidden" name="id" value="<?=$row['id']?>">
          <td><button type="submit" >[保存]</button></td>
          </form>
  
    </div>    
  </div>

  </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>