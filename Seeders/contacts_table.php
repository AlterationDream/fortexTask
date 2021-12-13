<?php
$sql = "CREATE TABLE contacts (
ContactID BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
PersonID BIGINT(20) UNSIGNED,
Contact VARCHAR(191) NOT NULL
)";
$db->runVoidSQL($sql);

$table = 'contacts';
$columns = ['PersonID', 'Contact'];
$values = [
    [1, '901-23456789'],
    [2, '901-23456789'],
    [3, '704-30523442'],
    [4, '901-23456789'],
    [5, '704-30523442'],
    [6, '545-45234523'],
    [7, '876-98712345'],
    [8, '532-48973248'],
    [9, '637-98374586'],
    [10, '876-98712345'],
    [11, '532-48973248'],
    [12, '901-23456789'],
    [13, '704-30523442'],
    [14, '532-48973248'],
    [15, '901-23456789'],
];
$db->insert($table, $columns, $values);