<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Задание 2 - Группы зданий</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <a href="/"><b>< Назад</b></a>
    <h3>Задание 2 - Группы зданий</h3>

    <?php require_once('../Controllers/BuildingGroupsController.php');
    echo BuildingGroupsController::getGroups(); ?>

</body>
</html>