
<?php
require "functions.php";
$pdo = connectDB();

$stmt1 = $pdo->prepare("SELECT * FROM address;");
$status = $stmt1->execute();

if($status==false) {
  $error = $stmt1->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  while( $result = $stmt1->fetch(PDO::FETCH_ASSOC)){
    
    $view .='<tr>';

    $view .= "<p>";
    $view .= '<td>'.'<a href="address_detail.php?id='.$result["id"].'">';
    $view .= $result['name'].'</td>'.'<td>'.$result['email'].'</td>'.'<td>'.$result['phone'].'</td>'.'<td>'.$result['relation'].'</td>';
    $view .= "</a>";

    $view .= "  ";
    $view .= '<td>'.'<a href="address_delete.php?id='.$result["id"].'">';
    $view .= "[ 削除 ]".'</td>';
    $view .= "</a>";
    $view .= "</p>";

    $view .='</tr>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>address</title>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<a href='../index.php'>return to top</a>
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
            <form action="insert_address.php" method="post">
              <td><input type="text" name="name"></td>
              <td><input type="text" name="email"></td>
              <td><input type="text" name="phone"></td>
              <td><input type="text" name="relation"></td>
          </tr>
        </tbody>
      </table>
               <button type="submit" class="btn btn-primary">保存</button>
            </form>
    </div>
  </div>
</div>
  

  
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
              <?=$view?>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>