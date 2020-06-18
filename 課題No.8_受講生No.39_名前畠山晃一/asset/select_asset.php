
<?php
require "functions.php";
$pdo = connectDB();

$stmt = $pdo->prepare("SELECT * FROM asset;");
$status = $stmt->execute();

if($status==false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    
    $view .='<tr>';
    $view .= '<td>'.$result['bank'].'</td>'.'<td>'.$result['stock'].'</td>'.'<td>'.$result['insurance'].'</td>'.'<td>'.$result['estate'].'</td>';
    $view .='</tr>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>assets</title>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    body{font-family:'serif'}
    p{font-size:20px;padding:30px 40px 30px 0px;}
    .title{font-size:40px;margin:100px 40px 30px 0px;}
    input{margin:20px 10px 30px 10px;width:100px;}
    .result{margin-left:50px;margin-bottom:50px;}
    .guide{font-size:20px;margin-top:50px;}
    /*.guideline{padding:0 auto;}*/
    span{font-size:10px;}
    </style>
</head>
<body>
<a href='../index.php'>return to top</a>
<div class="container mt-5">

<section class="section1">
  <div class="title"><h>相続のレコードと相続税シミュレーション</h></div>
    <form name="form" id="person">
        <table>
            <tr>
              <td><input type="checkbox" name="" onclick="clickButton()"></td> <td><label>配偶者</label></td></tr>
            <tr>
              <td><input type="checkbox" name="" onclick="clickButton()"></td> <td><label>父・母</label></td></tr>
            <tr>
              <td></td><td><label>子</label>
              <input  name="number" type="number" value="0" style="width:50px;" onclick="clickButton()">
        </table>
    </form>
    <div class="result">
      <table>
        <td ><p>法定相続人の人数</p></td>
        <td><input placeholder="" id="personTotal" type="text"></td>
      </table>
    </div>
</section>

<section class="section2">
  <table>
    <tr>
      <td><input class="check" data-price="1price" id="" name="" type="checkbox"></td>
      <td><label for="1">現金・預貯金</label></td>
      <td><input placeholder="" class="price" id="1price" name="" type="text" value="2000">万円</td>
    </tr>

    <tr>
      <td><input class="check" data-price="2price" id="" name="" type="checkbox"></td>
      <td><label for="2">有価証券（株・債権・投資信託）</label></td>
      <td><input placeholder="金額" class="price" id="2price" name="" type="text" value="2000">万円</td>
    </tr>

    <tr>
      <form name="form1">
          <td><input class="check" data-price="3price" id="" name="insurance" type="checkbox" ></td>
      </form>
          <td><label for="3">死亡保険</label></td>
          <td><input placeholder="金額" class="price" id="3price" name="" type="text" value="2000">万円</td>
    </tr>

    <tr>
      <td><input class="check" data-price="4price" id="" name="" type="checkbox" ></td>
      <td><label for="4">不動産（土地・家屋）</label></td>
      <td><input placeholder="金額" class="price" id="4price" name="" type="text" value="2000">万円</td>
    </tr>

    <tr>
    <td><input class="check" data-price="5price" id="" name="" type="checkbox" ></td>
    <td><label for="5">その他財産</label></td>
    <td><input placeholder="金額" class="price" id="5price" name="" type="text" value="2000">万円</td>
    </tr>
  </table>

  <div class="result">
    <table>
    <tr>
      <td><p><label for="priceTotal">財産総額</label></p></td>
      <td><input placeholder="合計金額" id="priceTotal" name="priceTotal" type="text">万円</td>
      <td></td>
    </tr>
    </table>
  </div>

</section>

<section class="section3">
  <!--<div style=display:none;>-->
  <table>
    <tr>
      <td><label for="priceTotal">財産総額</label>
      <input placeholder="" id="totalA" name="priceTotal" type="text" value="0">万円</td>
      <td>　−　</td>

      <td><label for="priceTotal">死亡保険金非課税枠</label>
      <input placeholder="" id="totalB" name="priceTotal" type="text" value="0">万円</td>
      <td>　=　</td>

      <td><label for="priceTotal">合計課税価格</label>
      <input placeholder="" id="totalC" name="priceTotal" type="text" value="0">万円</td>
    </tr>

    <tr>
      <td><label for="priceTotal">合計課税価格</label>
      <input class="" placeholder="" id="totalD" name="priceTotal" type="text" value="0">万円</td>
      <td>　−　</td>

      <td><label for="priceTotal">基礎控除額</label>
      <input placeholder="" id="totalE" name="priceTotal" type="text" value="0">万円</td>
      <td>　=　</td>

      <td><label for="priceTotal">課税遺産総額</label>
      <input placeholder="" id="totalF" name="priceTotal" type="text" value="0">万円</td>
    </tr>
  </table>

  <table>
    <td>
    <p>相続税の総額試算</p></td>
    <td><input placeholder="合計金額" id="totalG" name="priceTotal" type="text" value="0">万円
    </td>
  </table>
</section>

<section class="section4">
<!--</div>-->
  <div class="guideline">
    <label class="guide">参考：死亡保険金の非課税枠とは？</label>
      <p><span>生命保険の死亡保険金には、一定の金額までが相続税の非課税枠となる税制上の優遇措置があります</span></br>
      <span>例：配偶者および子２名が法定相続人の場合、非課税枠は500万円×3人＝1500万円となります。</span></p>
      <img src="../img/asset_1.jpg">

      </br><label class="guide">参考：基礎控除額とは？</label>
      <p><span>相続には、一定金額までは相続税が発生しない基礎控除があります。</span></br>
      <span>例：3,000万円  ＋  600万円  ×  2人（法定相続人の人数）</span></p>
      <img src="../img/asset_2.jpg">
      <p><span>出典：https://www.shinseibank.com</span></p>
  </div>
</section>


    <div class="col-md-12">
      <table class="table">
        <thead>
            <tr>
              <th>現金・預貯金</th>
              <th>有価証券</th>
              <th>死亡保険</th>
              <th>不動産</th>
              <th>その他</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <form action="insert_asset.php" method="post">
              <td><input type="text" name="bank"></td>
              <td><input type="text" name="stock"></td>
              <td><input type="text" name="insurance"></td>
              <td><input type="text" name="estate"></td>
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
              <th>現金・預貯金</th>
              <th>有価証券</th>
              <th>死亡保険</th>
              <th>不動産</th>
              <th>その他</th>
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


<script>

function clickButton(){
    var number1 = $('#person input:checkbox:checked').length;//#person内でcount
    var number2 = parseInt(document.form.number.value);
    var number3 = number1+number2;
      $("#personTotal").val();
      $("#personTotal").val(number3);
}

$(function(){
      $(document).on('change', 'input[class = "check"]' ,function(){
          calcPrice();
    });

      //金額フィールドのフォーカスアウト
      $('.price').focusout(function(){
          calcPrice();
    });

  function calcPrice(){
      var price = [];
        //チェックされたものだけ回す
        $('input[class = "check"]:checked').each(function(){
        //数値型に変換して変数に代入
        var number = parseInt($("#" + $(this).attr('data-price')).val());               
        price.push(number);//配列に入れる
      });

        var price_total = 0;
        for(var i = 0, len = price.length;i < len; i++){
        price_total += price[i];
      }
      $("#priceTotal").val(price_total);

    var number3 = document.getElementById('personTotal').value;

//保険check：下の変数より先に行う。
if (document.form1.elements[0].checked){
        var totalB= (500 * number3);
        $("#totalB").val(totalB);
      }else{
        var totalB = 0;
        $("#totalB").val(0);
    }

    var totalA= price_total;
    //var totalB= (500 * number3);
    var totalC= totalA-totalB;
    var totalD= totalC;//document.getElementById('totalC').value;
    var totalE= 3000 + (number3 * 600);
    var totalF= totalC-totalE;

    $("#totalA").val(price_total);
    $("#totalE").val(totalE);

//控除check
    if (totalC <= 0){
          var totalC = 0;
          $("#totalC").val(totalC);
          $("#totalD").val(totalD);
        }else{
          $("#totalC").val(totalC);
          $("#totalD").val(totalD);

      if (totalF <= 0){
          var totalF = 0;
          $("#totalF").val(totalF);
          $("#totalG").val(totalF);//考え中。
        }else{
          $("#totalF").val(totalF);
          $("#totalG").val(totalF);//考え中。
        }
    }
  }  
});

</script>
</body>
</html>