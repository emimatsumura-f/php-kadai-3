<?php
// var_dump($_POST);
// exit();


if (!isset($_GET['id'])) {
    echo "IDが指定されていません。";
    exit();
}

// id受け取り
include('function.php');

// DB接続
$id = $_GET['id'];
$pdo = connect_to_db();

// SQL実行
$sql = 'SELECT * FROM healthcare WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($record);
// exit();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>猫の健康観察 編集</title>
</head>

<body>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?= $record['id'] ?>">
        <fieldset>
            <legend>入力編集</legend>
            <a href="read.php">一覧画面</a>

            <div>
                日付: <input type="date" name="input_date" value="<?= $record['input_date'] ?>">
            </div>
            <div>
                体重(kg): <input type="text" name="weight" value="<?= implode(',', json_decode($record['weight'], true)) ?>">
            </div>
            <div>
                尿量(ml): <input type="text" name="pee" value="<?= implode(',', json_decode($record['pee'], true)) ?>">
            </div>
            <div>
                1日の尿量: <input type="text" name="total_pee" value="<?= $record['total_pee'] ?>">
            </div>
            <div>
                尿量/体重(ml/kg): <input type="text" name="manual_pee_ratio" value="<?= $record['manual_pee_ratio'] ?>">
            </div>
            <div>
                💩: <input type="text" name="poop" value="<?= $record['poop'] ?>">
            </div>


            <div>
                <button>submit</button>
            </div>
        </fieldset>
    </form>
</body>

</html>