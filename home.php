<!DOCTYPE html>
<html lang="ja">
<head>
  <meta "charset=UTF-8">
  <title>You柔不断</title>
  <link href="css/home.css" type="text/css" rel="stylesheet">
</head>
<body>
  <div class="title">You柔不断</div>
  <div class="subtitle">～今日は何する？～</div>
  <br>
  <?php
  $dsn = 'mysql:dbname=g128kato4;host=localhost';
  $user = 'g128kato';
  $password = '';
  session_start();
  try{
    $dbh = new PDO($dsn, $user, $password);

    if(!empty($_POST['action'])){
      $user_id = $_SESSION['user_id'];
      $action = $_POST['action'];
      $place = $_POST['place'];
      $number_person = $_POST['number_person'];
      $time = $_POST['time'];
      $cost = $_POST['cost'];
      $share = $_POST['share'];

      $sql = "INSERT INTO list (user_id, action, place, number_person, time, cost, share) VALUE (:user_id, :action, :place, :number_person, :time, :cost, :share)";
      $prepare = $dbh->prepare($sql);

      $prepare->bindValue(":user_id", $user_id);
      $prepare->bindValue(":action", $action);
      $prepare->bindValue(":place", $place);
      $prepare->bindValue(":number_person", $number_person);
      $prepare->bindValue(":time", $time);
      $prepare->bindValue(":cost", $cost);
      $prepare->bindValue(":share", $share);
      $execute=$prepare->execute();
    }
  } catch (PDOException $e) {
    echo "接続失敗: ".$e->getMessage()."\n";
    exit();
  }
  ?>
  <hr>
  <div class="action">
    <?php
    if (!isset($_SESSION['user_id'])) {
      header("Location: login.php");
      exit();
    }

    $user_id = $_SESSION['user_id'];
    $q = $dbh->query("SELECT*FROM list WHERE user_id LIKE '$user_id'");
    foreach ($q as $row) {
      print $row["action"];
      print "<br>";
    }
    ?>
  </div>
  <hr>
  <div align="center">
    <input class="btn0" type="submit" value="することを決める" onclick="location.href='./decision.php'">
    <input class="btn" type="button" value="絞り込む" onclick="location.href='./detail.php'">
    <input class="btn" type="button" value="追加" onclick="location.href='./add.php'">
    <input class="btn" type="button" value="削除" onclick="location.href='./delete.php'">
  </div>
</body>
</html>
