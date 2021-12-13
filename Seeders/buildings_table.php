<?php
$sql = "CREATE TABLE buildings (
BuildID BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Address VARCHAR(191) NOT NULL
)";
$db->runVoidSQL($sql);

$table = 'buildings';
$columns = ['Address'];
$values = ['Тестовая 11', 'Протестовая 18', 'Кинологов 19',
    'Домашняя 10', 'Криворукова 20', 'Капиталистическая 80',
    'Николая Абсурдова 30', 'Дерягина 11', 'Лермнотова 275Б'];
$db->insert($table, $columns, $values);