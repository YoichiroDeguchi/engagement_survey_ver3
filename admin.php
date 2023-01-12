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

// SQL実行
$sql = 'SELECT * FROM answer_table';
$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["year"]}</td>
      <td>{$record["gender"]}</td>
      <td>{$record["age"]}</td>
      <td>{$record["affiliation"]}</td>
      <td>{$record["occupation"]}</td>
      <td>{$record["length"]}</td>
      <td>{$record["q1"]}</td>
      <td>{$record["q2"]}</td>
      <td>{$record["q3"]}</td>
      <td>{$record["q4"]}</td>
      <td>{$record["q5"]}</td>
      <td>{$record["q6"]}</td>
      <td>{$record["q7"]}</td>
      <td>
        <a href='delete.php?id={$record["id"]}'>delete</a>
      </td>
    </tr>
  ";
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>engagement survey</title>
</head>
<body>
  <fieldset>
    <legend>回答リスト</legend>
    <table>
      <thead>
        <tr>
          <th>year</th>
          <th>gender</th>
          <th>age</th>
          <th>affiliation</th>
          <th>occupation</th>
          <th>length</th>
          <th>q1</th>
          <th>q2</th>
          <th>q3</th>
          <th>q4</th>
          <th>q5</th>
          <th>q6</th>
          <th>q7</th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>

    <div class="text-center">
        <a href="result.php">戻る</a>
    </div>


</body>
</html>