<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Задание 1 - События</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <a href="/"><b>< Назад</b></a>

    <h3>Задание 1 - События</h3>

    <form action="events.php" method="GET">
        <h3>Введите ID клиента для вычисления интервалов работы пользователей.</h3>
        <input type="number" name="clientID" value="<?=$_GET['clientID'] ?? ''?>">
        <input type="submit" value="Вычислить">
    </form>

    <?php if (isset($_GET['clientID'])) {
        require_once('../Controllers/IntervalsController.php');
        echo IntervalsController::getClientIntervals($_GET['clientID']);
    } ?>

</body>
</html>
