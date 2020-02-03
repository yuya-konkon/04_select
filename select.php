<?php
// 接続に必要な情報を定義
define('DSN', 'mysql:host=mysql;dbname=pet_shop;charset=utf8;');
define('USER', 'staff');
define('PASSWORD', '9999');

// DBに接続
try {
  $dbh = new PDO(DSN, USER, PASSWORD);
} catch (PDOException $e) {
  // 接続がうまくいかない場合こちらの処理がなされる
  echo $e->getMessage();
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $keyword = $_GET['keyword'];
  if ($keyword == '') {
    $sql = "select * from animals";
    $stmt = $dbh->prepare($sql);
  } else {
    $sql = "select * from animals where description like :keyword ";
    $stmt = $dbh->prepare($sql);
    $keyword = '%' . $keyword . '%';
    $stmt->bindParam(":keyword", $keyword);
  }
  $stmt->execute();
  $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ペットショップ</title>
</head>

<body>
  <h2>本日のご紹介ペット！</h2>
  <p>
    <form action="" method="GET">
      <label for="keyword">キーワード:
        <input type="text" name="keyword" placeholder="キーワードの入力">
      </label>
      <input type="submit" value="検索">
    </form>

    <!-- ここでforeachを使用してデータを出力 -->
    <?php foreach ($animals as $animal) : ?>
      <?php echo $animal['type'] . 'の' . $animal['classifcation'] . 'ちゃん' . '<br>' . $animal['description'] . '<br>' . $animal['birthday'] . ' 生まれ' . '<br>' . '出身地 ' . $animal['birthplace'] . '<hr>'; ?>
    <?php endforeach; ?>

  </p>
</body>

</html>