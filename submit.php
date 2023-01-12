<?php
// POSTデータ確認
if (
    !isset($_POST['year']) || $_POST['year'] === '' ||
    !isset($_POST['gender']) || $_POST['gender'] === '' ||
    !isset($_POST['age']) || $_POST['age'] === '' ||
    !isset($_POST['affiliation']) || $_POST['affiliation'] === '' ||
    !isset($_POST['occupation']) || $_POST['occupation'] === '' ||
    !isset($_POST['length']) || $_POST['length'] === '' ||
    !isset($_POST['q1']) || $_POST['q1'] === '' ||
    !isset($_POST['q2']) || $_POST['q2'] === '' ||
    !isset($_POST['q3']) || $_POST['q3'] === '' ||
    !isset($_POST['q4']) || $_POST['q4'] === '' ||
    !isset($_POST['q5']) || $_POST['q5'] === '' ||
    !isset($_POST['q6']) || $_POST['q6'] === '' ||
    !isset($_POST['q7']) || $_POST['q7'] === ''
) {
  exit('ParamError');
}

$year = $_POST['year'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$affiliation = $_POST['affiliation'];
$occupation = $_POST['occupation'];
$length = $_POST['length'];
$q1 = $_POST['q1'];
$q2 = $_POST['q2'];
$q3 = $_POST['q3'];
$q4 = $_POST['q4'];
$q5 = $_POST['q5'];
$q6 = $_POST['q6'];
$q7 = $_POST['q7'];

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

// SQL作成&実行
$sql = 'INSERT INTO answer_table (id, year, gender, age, affiliation, occupation, length, q1, q2, q3, q4, q5, q6, q7, created_at, updated_at) VALUES (NULL, :year, :gender, :age, :affiliation, :occupation, :length, :q1, :q2, :q3, :q4, :q5, :q6, :q7, now(), now())';
$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':year', $year, PDO::PARAM_STR);
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$stmt->bindValue(':affiliation', $affiliation, PDO::PARAM_STR);
$stmt->bindValue(':occupation', $occupation, PDO::PARAM_STR);
$stmt->bindValue(':length', $length, PDO::PARAM_STR);
$stmt->bindValue(':q1', $q1, PDO::PARAM_STR);
$stmt->bindValue(':q2', $q2, PDO::PARAM_STR);
$stmt->bindValue(':q3', $q3, PDO::PARAM_STR);
$stmt->bindValue(':q4', $q4, PDO::PARAM_STR);
$stmt->bindValue(':q5', $q5, PDO::PARAM_STR);
$stmt->bindValue(':q6', $q6, PDO::PARAM_STR);
$stmt->bindValue(':q7', $q7, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
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
    <!-- 回答終了画面 -->
    <div id="questionEndBox">
        <h2 class="text-center">ご協力ありがとうございました！</h2>
        <p>調査はこれで終了です。今回の結果をもとに、継続的に改善案を策定していきます。<br>
            ブラウザを閉じて終了してください。</p>
        <a href="top.php" class="answer_top_btn answer_top_btn2">TOPへ戻る</a>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="main.js"></script>

</body>
</html>