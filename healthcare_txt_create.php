<?php
// var_dump($_POST);
// exit();

$date = $_POST['date'];
$weight = $_POST['weight'];
$pee = $_POST['pee'];
$toilet_times = $_POST['toilet_times'];
$poop = $_POST['poop'];
$pee_ratio_result = $_POST['pee_ratio_result'];

$write_data = "{$date} {$weight} {$pee} {$toilet_times} {$poop} {$pee_ratio_result}\n";

$file = fopen('date/healthcare.txt', 'a');
flock($file, LOCK_EX);
fwrite($file, $write_data);
flock($file, LOCK_UN);
fclose($file);

header("Location: healthcare_txt_input.php");
exit();
