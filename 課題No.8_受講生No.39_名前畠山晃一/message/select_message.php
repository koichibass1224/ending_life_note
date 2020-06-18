<?php
require_once 'functions.php';
$pdo = connectDB();

$stmt = $pdo->prepare("SELECT * FROM message;");
$status = $stmt->execute();

if($status==false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){  
    $view .= '<a href="message_detail.php?id='.$result["id"].'">';
    $view .= $result['who'].'</a>'.'<br>';
  }
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
      border:3px solid #000;}
    .who{margin-top:100px;}
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
      <td><textarea name="who" cols="100%" rows="1"></textarea></td>
      <td><textarea name="message"  cols="100%" rows="10"></textarea></td>
        <canvas class="canvas" id="drawarea" width="300" height="300"></canvas>
          <input type="button" id="save_btn" value="保存"> 
    </form>
  <div class="who">
  <p>
  メッセージを呼び出す：<br>
  <?=$view?>
  </p>
  </div>

  </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>

let canvas_mouse_event = false;
let oldX = 0;
let oldY = 0;
let bold_line = 3;
let color = "#000000";

const can =$("#drawarea")[0];
const ctx = can.getContext("2d");

//mouse_on event
$(can).on("mousedown", function(e){
 oldY = e.offsetY;
 oldX = e.offsetX;
 canvas_mouse_event = true;
});

//draw
$(can).on("mousemove",function(e){
if (canvas_mouse_event == true){
const px = e.offsetX;
const py = e.offsetY;
ctx.strokeStyle = color;
ctx.lineWidth = bold_line;
ctx.beginPath();
ctx.lineJoin= "round";
ctx.lineCan= "round";
ctx.moveTo(oldX,oldY);
ctx.lineTo(px,py);
ctx.stroke();
oldX = px;
oldY = py;
}
});

//finish by mouseup
$(can).on("mouseup",function(){
canvas_mouse_event = false;
});

//save_event
$("#save_btn").on("click",function(){
var canvas = document.getElementById("drawarea");
var message = document.form.message.value; //document.getElementById(""),valueでもok
var who = document.form.who.value; 
var url = canvas.toDataURL();
var url2 = JSON.stringify(url);//JSONで渡さないと呼び込めない。

$.ajax({
  type: 'POST',
  url: 'insert_message.php',
  data: {
    'message' : message,
    'who' : who,
    'sign' : url2,
  },
  /*success: function(data) {
    alert(url);
  }*/
});
});

  </script>

</body>
</html>

