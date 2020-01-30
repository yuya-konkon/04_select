<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ペットショップ検索</title>
</head>

<body>
  <h1>本日のご紹介ペット！</h1>
  <p>
    <form action="" method="post">
      キーワード:
      <input type="text" name="description" placeholder="キーワードの入力">
      <input type="submit" value="検索">
    </form>
  </p>
</body>

</html>

<?php

define('DSN', 'mysql:host=mysql;dbname=pet_shop;charset=utf8;');
define('USER', 'staff');
define('PASSWORD', '9999');
try {
  $dbh = new PDO(DSN, USER, PASSWORD);
} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}

$sql = "select * from animals where description like '%おっとり%'";

$stmt = $dbh->prepare($sql);

$stmt->execute();
$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($animals as $animal) {
  echo $animal['type'] .  'の' . $animal['classifcation'] . 'ちゃん' . '<br>' . $animal['description'] . '<br>' . $animal['birthday'] . ' 生まれ' . '<br>' . '出身地 ' . $animal['birthplace'] . '<hr>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $description = $_POST['description'];
};

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$description = $_POST['description'];
};

?>