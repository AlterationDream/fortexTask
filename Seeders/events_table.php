<?php
$sql = "CREATE TABLE events (
RecordID BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Date DATE NOT NULL,
Time TIME NOT NULL,
EventID BIGINT(20) UNSIGNED,
UserID BIGINT(20) UNSIGNED,
ClientID BIGINT(20) UNSIGNED
)";
$db->runVoidSQL($sql);

$table = 'events';
$columns = ['Date', 'Time', 'EventID', 'UserID', 'ClientID'];
$values = [
    ['2019-02-01', '15:00', 2, 100, 5],
    ['2019-02-01', '17:00', 2, 150, 5],
    ['2019-02-05', '12:00', 2, 200, 5],
    ['2019-02-05', '15:00', 3, 100, 5],
    ['2019-02-06', '15:00', 2, 200, 5],
];
$db->insert($table, $columns, $values);