<?php
// テキストファイルをCSVに変換
$inputFile = 'date/healthcare.txt';
$outputFile = 'date/healthcare.csv';

// CSVファイルを開く
$csvFile = fopen($outputFile, 'w');
fprintf($csvFile, chr(0xEF) . chr(0xBB) . chr(0xBF));

// ヘッダーを書き込む
$header = ['日付', '体重(kg)', '尿量(ml)', 'トイレ回数', '排便', '尿量/体重(ml/kg)'];
fputcsv($csvFile, $header);

// テキストファイルの各行を読み込み、CSVに書き込む
$lines = file($inputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    $data = explode(' ', trim($line));
    fputcsv($csvFile, $data);
}

// ファイルを閉じる
fclose($csvFile);

// ダウンロード処理
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="healthcare.csv"');
readfile($outputFile);
exit();
