<?php
include('function.php');

if (
    !isset($_POST['input_date']) || $_POST['input_date'] === '' ||
    !isset($_POST['weight']) || empty($_POST['weight']) ||
    !isset($_POST['pee']) || empty($_POST['pee']) ||
    !isset($_POST['total_pee']) || $_POST['total_pee'] === '' ||
    !isset($_POST['manual_pee_ratio']) || $_POST['manual_pee_ratio'] === '' ||
    !isset($_POST['poop']) || $_POST['poop'] === '' ||
    !isset($_POST['id']) || $_POST['id'] === ''
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
$id = $_POST['id'];

$pdo = connect_to_db();

// SQLクエリを修正
$sql = 'UPDATE healthcare 
        SET 
            input_date=:input_date, 
            weight=:weight, 
            pee=:pee, 
            total_pee=:total_pee, 
            manual_pee_ratio=:manual_pee_ratio, 
            poop=:poop, 
            updated_at=now() 
        WHERE id=:id';

// プリペアドステートメント
$stmt = $pdo->prepare($sql);

// すべてのバインド変数を正しく設定
$stmt->bindValue(':input_date', $input_date, PDO::PARAM_STR);
$stmt->bindValue(':weight', json_encode($weights), PDO::PARAM_STR);
$stmt->bindValue(':pee', json_encode($pees), PDO::PARAM_STR);
$stmt->bindValue(':total_pee', $total_pee, PDO::PARAM_STR);
$stmt->bindValue(':manual_pee_ratio', $manual_pee_ratio, PDO::PARAM_STR);
$stmt->bindValue(':poop', $poop, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
    $status = $stmt->execute();

    if ($status) {
        header('Location: read.php');
        exit();
    } else {
        echo "更新に失敗しました。";
    }
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
