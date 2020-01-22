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

$sql = 'SHOW TABLES';
$stmt = $dbh->query($sql);
while ($result = $stmt->fetch(PDO::FETCH_NUM)) {
  $table_names[] = $result[0];
}

$table_data = array();
foreach ($table_names as $key => $val) {
  $sql2 = "SELECT * FROM $val;";
  $stmt2 = $dbh->query($sql2);
  $table_data[$val] = array();
  while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    foreach ($result2 as $key2 => $val2) {
      $table_data[$val][$key2] = $val2;
    }
  }
}

foreach ($table_data as $key => $val) {
  if (empty($val)) {
    continue;
  }
  foreach ($table_data[$key] as $key2 => $val2) {
    echo $val2;
  }
}
