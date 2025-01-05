<?php
// var_dump($_POST);
// exit();

include('function.php');

// function connect_to_db()
// {
//     // データベース接続設定
//     $dbn = 'mysql:dbname=php_kadai_3;charset=utf8mb4;port=3306;host=localhost';
//     $user = 'root';
//     $pwd = '';

//     // データベース接続
//     try {
//         return new PDO($dbn, $user, $pwd);
//         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         return $pdo;
//     } catch (PDOException $e) {
//         exit("DB接続エラー: " . $e->getMessage());
//     }
// }

// 関数を呼び出して$pdoに代入
$pdo = connect_to_db();

$sql = 'SELECT * FROM healthcare ORDER BY input_date ASC';

$stmt = $pdo->prepare($sql);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
    $output .= "
    <tr>
    <td>{$record["input_date"]}</td>
    <td>{$record["weight"]}</td>
    <td>{$record["manual_pee_ratio"]}</td>
    <td>{$record["total_pee"]}</td>
    <td>{$record["poop"]}</td>
    <td>{$record["pee"]}</td>
    <td>
        <a href='edit.php?id={$record["id"]}'>編集</a>
    </td>
    <td>
        <a href='delete.php?id={$record["id"]}'>削除</a>
    </td>
    </tr>
";
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>猫の健康観察 入力一覧</title>
    <style>
        table {
            border-collapse: collapse;
            /* 枠線を重ねて表示 */
        }

        th,
        td {
            border: 1px solid black;
            /* 黒の1px実線 */
            padding: 8px;
            /* セル内の余白 */
        }
    </style>
</head>

<body>
    <fieldset>
        <legend>
            <h2>記録一覧</h2>
        </legend>
        <a href="index.php">入力画面</a>
        <table>
            <thead>
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>尿量/体重</th>
                    <th>1日の尿量</th>
                    <th>💩</th>
                    <th>尿量</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                <?= $output ?>
            </tbody>
        </table>
</body>

</html>