<?php
// GETでidを取得
$id = $_GET["id"];

// DBに接続
require "functions.php";
$pdo = connectDB();

// 対象データ取得
$stmt = $pdo->prepare("SELECT * FROM address WHERE id=:id");
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
    <title>profile</title>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
            <tr>
              <th>名前</th>
              <th>メールアドレス</th>
              <th>電話番号</th>
              <th>関係性</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <form action="address_update.php" method="post">
              <td><input type="text" name="name" value="<?=$row['name']?>"></td>
              <td><input type="text" name="email" value="<?=$row['email']?>"></td>
              <td><input type="text" name="phone" value="<?=$row['phone']?>"></td>
              <td><input type="text" name="relation" value="<?=$row['relation']?>"></td>
              <input type="hidden" name="id" value="<?=$row['id']?>">
          </tr>
        </tbody>
      </table>
               <button type="submit" class="btn btn-primary">保存</button>
            </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>