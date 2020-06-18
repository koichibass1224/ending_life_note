<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ending_life_note</title>
  <style>
body{
  background-image: url("img/top.jpg");
  background-size: cover;
  background-position: top;
  background-repeat: no-repeat;
}
.wrapper{
  position:relative;
  top:50%;
}
/* Animation-1 */
html{
  min-height: 100%;
  overflow: hidden;
}
body{
  height: calc(100vh - 8em);
  padding: 4em;
  color: rgba(255,255,255,.75); 
  background-color: rgb(25,25,25);  
}
.line-1{
    position: relative;
    top: 50%;  
    width: 18em;
    margin: 0 auto;
    border-right: 2px solid rgba(255,255,255,.75);
    font-size: 180%;
    color:white;
    font-family:'serif';
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    transform: translateY(-50%);    
}

/* Animation-2 */
.anim-typewriter{
  animation: typewriter 4s steps(44) 1s 1 normal both,
 blinkTextCursor 500ms steps(44) infinite normal;
}
@keyframes typewriter{
  from{width: 0;}
  to{width: 18em;}
}
@keyframes blinkTextCursor{
  from{border-right-color: rgba(255,255,255,.75);}
  to{border-right-color: transparent;}
}

/*Animation _ fadeIn*/
.fade{
animation: fadeIn 10s ;
animation-delay: 3s ;
animation-fill-mode:forwards;
color:white;
font-family:'serif';
display:block;
}
.fade p{
  padding:0 49%;
}
.fade a{
  padding:0 48%;
  display:block;
}
@keyframes fadeIn { /*animetion-nameで設定した値を書く*/
0% {opacity: 0} /*アニメーション開始時は不透明度0%*/
100% {opacity: 1} /*アニメーション終了時は不透明度100%*/
}
  </style>

   <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
<div class="wrapper" >
    <p class="line-1 anim-typewriter">Ending_life_Note</p>
    <div class="fade"><!--<p></p>-->
    <a href="index.php">ENTER</a></div>
</div>

<!--bootstrap-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>