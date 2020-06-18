<?php

$id = $_GET["id"];

require "functions.php";
$pdo = connectDB();

$stmt = $pdo->prepare("SELECT * FROM message WHERE id=:id");
$stmt ->bindvalue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) { 
  sql_error($stmt);
}else{
  $row = $stmt->fetch();
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Message</title>

      <!--bootstrap-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <style>
    body{font-family:'serif';}
    canvas {
      position: relative;
      border:3px solid #000;
    }
  </style>
</head>
<body>
<a href='../index.php'>return to top</a>

<!--message/input-->
<div class="container profile">
  <div class="row">
    <div class="inbox col-md-12">

 <h1>Message</h1>
  <p>一番大切な人へのメッセージを残しましょう。</p>
  <form name="form">
      <td><textarea name="who" cols="100%" rows="1"><?=$row['who']?></textarea></td>
      <td><textarea name="message"  cols="100%" rows="10"><?=$row['message']?><?=$message?></textarea></td>
      <canvas class="canvas" id="drawarea" width="300" height="300"></canvas>
      <input type="button" id="btn1" value="呼出" onclick="setBase64();">
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
//load_event
function setBase64(){
  var cvs = document.getElementById('drawarea');
  var ctx= cvs.getContext('2d');

  var img = new Image();
  var url = JSON.parse('<?=$row['sign']?>');//JSON: data parse
  console.log(url);
  img.src = url;
  img.onload = function(){
  ctx.drawImage(img, 0, 0, 300, 300); //fix to canvas size
  }
}
  </script>

</body>
</html>

