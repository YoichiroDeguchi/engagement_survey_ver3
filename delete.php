<?php
// DB接続
$dbn ='mysql:dbname=engagement_survey;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

$id = $_GET['id'];

// SQL実行
$sql = 'DELETE FROM answer_table WHERE id=:id';
// $sql = 'UPDATE answer_table SET deleted_at=now() where id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:admin.php");
exit();
?>