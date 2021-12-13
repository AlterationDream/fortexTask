<?php
$sql = "CREATE TABLE persons (
PersonID BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(191) NOT NULL,
BuildID BIGINT(20) UNSIGNED
)";
$db->runVoidSQL($sql);

$table = 'persons';
$columns = ['Name', 'BuildID'];
$values = [
    ['Иван Петров', 1],
    ['Администратор', 1],
    ['Евгений Желудков', 2],
    ['Алексей Зорикто', 3],
    ['Вениамин Денюков', 4],
    ['Павел Кляков', 5],
    ['Жанна Актова', 6],
    ['Ростислав Приблудкин', 6],
    ['Результат Желаемый', 6],
    ['Ксения Вобщакова', 7],
    ['Иннокентий Катышкин', 8],
    ['Вячеслав Властин', 8],
    ['Многотекст Буков', 8],
    ['Самиздат Громкотихих', 9],
    ['Достовер Златов', 9]
];
$db->insert($table, $columns, $values);