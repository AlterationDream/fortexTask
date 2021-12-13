<?php
$sql = "CREATE TABLE other_buildings (
BuildID BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Address VARCHAR(191) NOT NULL
)";
$db->runVoidSQL($sql);

$table = 'other_buildings';
$columns = ['Address'];
$values = [];
$characters = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя';
for ($i = 0; $i <= 1500; $i++) {
    $streetName = '';
    $wordCount = random_int(1, 2);
    for ($j = 0; $j < $wordCount; $j++) {
        $word = '';
        $wordCharCount = random_int(2, 16);
        for ($k = 0; $k < $wordCharCount; $k++) {
            $word .= mb_substr($characters, random_int(0, mb_strlen($characters) - 1), 1);
        }
        $streetName .= $word . ' ';
    }
    $streetName = mb_convert_case($streetName, MB_CASE_TITLE, 'UTF-8');
    $streetName .= random_int(1, 99);
    array_push($values, $streetName);
}
$db->insert($table, $columns, $values);