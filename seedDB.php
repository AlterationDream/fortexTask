<?php require_once('Database/db.php');
$db = new DataBase();
$db->connect();

require_once('Seeders/events_table.php');
require_once('Seeders/buildings_table.php');
require_once('Seeders/persons_table.php');
require_once('Seeders/contacts_table.php');
require_once('Seeders/other_buildings.php');
require_once('Seeders/intervals_table.php');
?>

<a href="/"><b>< Назад</b></a>
<h3>База данных успешно заполнена!</h3>