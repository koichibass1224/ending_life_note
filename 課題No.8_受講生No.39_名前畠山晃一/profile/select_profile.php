<?php
require_once 'functions.php';
$pdo = connectDB();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // 画像を取得
    $sql = 'SELECT * FROM images ORDER BY created_at DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $images = $stmt->fetchAll();

} else {
    // 画像を保存
    if (!empty($_FILES['image']['name'])) {
        $name = $_POST["name"];//コメント
        $content = file_get_contents($_FILES['image']['tmp_name']);

        $sql = 'INSERT INTO images(image_name,image_content, created_at)
                VALUES (:image_name, :image_content, now())';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
        $stmt->execute();
    }
    unset($pdo);
    header('Location:select_profile.php');
    exit();
}
unset($pdo);


//表示
//require "functions.php";
$pdo2 = connectDB();

$stmt1 = $pdo2->prepare("SELECT * FROM profile;");
$status = $stmt1->execute();

if($status==false) {
  $error = $stmt1->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  while( $result = $stmt1->fetch(PDO::FETCH_ASSOC)){
    $id .= $result['id'];

    $seinengappi .= $result['seinengappi'];
    $juusyo .= $result['juusyo'];
    $kakaritsuke .= $result['kakaritsuke'];

    $kaigo .= $result['kaigo'];
    $zouki .= $result['zouki'];
    $enmei .= $result['enmei'];
    $sougi .= $result['sougi'];
    $iei .= $result['iei'];
    $sougihiyou .= $result['sougihiyou'];

    $detail .= "<br>".'<a href="profile_detail.php?id='.$result["id"].'">'."[更新]"."</a>";
    $delete .= "<br>".'<a href="profile_delete.php?id='.$result["id"].'">'."[削除]"."</a>";
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>profile</title>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">-->
  <style>
    .profile{font-family:'serif';}
    button{margin-bottom:30px;}
    h1{margin-top:50px;}
    p{margin-top:30px;}
  </style>
</head>

<body>
<a href='../index.php'>return to top</a>

<!--image select-->
<div class="container mt-5">
    <div class="row">
      <!--image md-8-->
        <div class="col-md-8 border-right">
            <ul class="list-unstyled">
                <?php for($i = 0; $i < count($images); $i++): ?>
                    <li class="media mt-5">
                        <a href="#lightbox" data-toggle="modal" data-slide-to="<?= $i; ?>">
                            <img src="image.php?id=<?= $images[$i]['image_id']; ?>" width="100px" height="auto" class="mr-3">
                        </a>
                        <div class="media-body">
                            <h5><?= $images[$i]['image_name']; ?> </h5>
                            <a href="javascript:void(0);" 
                                onclick="var ok = confirm('削除しますか？'); if (ok) location.href='delete.php?id=<?= $images[$i]['image_id']; ?>'">
                                <i class="far fa-trash-alt"></i> 削除</a>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
        <!--select : md-4-->
        <div class="col-md-4 pt-4 pl-4">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>画像を選択</label><br>
                    <input type="file" name="image" required><br>
                    <br>
                    <label>コメント</label><br>
                    <textarea name="name" cols="30" rows="2"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
</div>

<!--zoom and slideshow-->
<div class="modal carousel slide" id="lightbox" tabindex="-1" role="dialog" data-ride="carousel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <ol class="carousel-indicators">
            <?php for ($i = 0; $i < count($images); $i++): ?>
                <li data-target="#lightbox" data-slide-to="<?= $i; ?>" <?php if ($i==0) echo 'class="active"'; ?>></li>
            <?php endfor; ?>
        </ol>
        <div class="carousel-inner">
            <?php for ($i = 0; $i < count($images); $i++): ?>
                <div class="carousel-item <?php if ($i==0) echo 'active'; ?>">
                  <img src="image.php?id=<?= $images[$i]['image_id']; ?>" class="d-block w-100">
                </div>
            <?php endfor; ?>
        </div>
        <a class="carousel-control-prev" href="#lightbox" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#lightbox" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div>

<!--profile select/input-->
<div class="container profile">
  <div class="row">
    <div class="inbox col-md-12">

        <h1>個人情報について</h1>
          <form action="insert_profile.php" method="post" >
          <p>生年月日</p>
          <td><textarea name="seinengappi" id="" cols="100%" rows="2"><?=$seinengappi?></textarea></td>

          <p>住所</p>
          <textarea name="juusyo" id="" cols="100%" rows="2"><?=$juusyo?></textarea>

          <p>かかりつけの病院・常備薬・持病など</p>
          <textarea name="kakaritsuke" id="" cols="100%" rows="2"><?=$kakaritsuke?></textarea>
  
        <h1>葬儀について</h1>
          <p>介護が必要となった際（認知症など）の方針</p>
          <textarea name="kaigo" id="" cols="100%" rows="2"><?=$kaigo?></textarea>
          <p>臓器提供の方針</p>
          <textarea name="zouki" id="" cols="100%" rows="2"><?=$zouki?></textarea>
          <p>終末期医療（延命措置など）の方針</p>
          <textarea name="enmei" id="" cols="100%" rows="2"><?=$enmei?></textarea>
          <p>葬儀・埋葬（納骨・墓）の方法</p>
          <textarea name="sougi" id="" cols="100%" rows="2"><?=$sougi?></textarea>
          <p>遺影の有無</p>
          <textarea name="iei" id="" cols="100%" rows="2"><?=$iei?></textarea>
          <p>葬式費用の負担について</p>
          <textarea name="sougihiyou" id="" cols="100%" rows="2"><?=$sougihiyou?></textarea>

          <input type="hidden" name="id" value="<?=$id?>">
          </br><td><button type="submit">[保存]</button></td></br>
          <td><?=$detail?></td>
          <td><?=$delete?></td>
          </form>

    </div>    
  </div>

  </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>