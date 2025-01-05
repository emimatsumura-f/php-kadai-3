<?php

function connect_to_db()
{
    // データベース接続設定
    $dbn = 'mysql:dbname=php_kadai_3;charset=utf8mb4;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';

    // データベース接続
    try {
        return new PDO($dbn, $user, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        exit("DB接続エラー: " . $e->getMessage());
    }
}
