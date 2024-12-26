<?php
// var_dump($_POST);
// exit();


// 入力チェック
if (
    !isset($_POST['input_date']) || $_POST['input_date'] === '' ||
    !isset($_POST['weight']) || empty($_POST['weight']) ||
    !isset($_POST['pee']) || empty($_POST['pee']) ||
    !isset($_POST['total_pee']) || $_POST['total_pee'] === '' ||
    !isset($_POST['manual_pee_ratio']) || $_POST['manual_pee_ratio'] === '' ||
    !isset($_POST['poop']) || $_POST['poop'] === ''
) {
    exit('Error: 必要な情報が不足しています');
}

// POSTデータの取得
$input_date = $_POST['input_date'];
$weights = $_POST['weight'];
$pees = $_POST['pee'];
$total_pee = $_POST['total_pee'];
$manual_pee_ratio = $_POST['manual_pee_ratio'];
$poop = $_POST['poop'];

// データベース接続設定
$dbn = 'mysql:dbname=php_kadai_3;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// データベース接続
try {
    $pdo = new PDO($dbn, $user, $pwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("DB接続エラー: " . $e->getMessage());
}

// SQL作成
$sql = 'INSERT INTO healthcare 
        (input_date, weight, pee, total_pee, pee_weight_ratio, poop) 
        VALUES 
        (:input_date, :weight, :pee, :total_pee, :pee_weight_ratio, :poop)';

try {
    // プリペアドステートメント
    $stmt = $pdo->prepare($sql);

    // 複数の体重と尿量を JSON 形式で保存
    $stmt->bindValue(':input_date', $input_date, PDO::PARAM_STR);
    $stmt->bindValue(':weight', json_encode($weights), PDO::PARAM_STR);
    $stmt->bindValue(':pee', json_encode($pees), PDO::PARAM_STR);
    $stmt->bindValue(':total_pee', $total_pee, PDO::PARAM_STR);
    $stmt->bindValue(':pee_weight_ratio', $manual_pee_ratio, PDO::PARAM_STR);
    $stmt->bindValue(':poop', $poop, PDO::PARAM_STR);

    // SQL実行
    $status = $stmt->execute();

    // リダイレクトまたは成功メッセージ
    header("Location: index.html?status=success");
    exit();
} catch (PDOException $e) {
    exit("SQL実行エラー: " . $e->getMessage());
}
