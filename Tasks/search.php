<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Задание 3 - Поиск по зданиям</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <a href="/"><b>< Назад</b></a>
    <h3>Задание 3 - Поиск по зданиям</h3>

    <input type="text" name="address" placeholder="Поиск...">

    <?php require_once('../Controllers/BuildingsListController.php');
    echo BuildingsListController::getBuildingsList();
    ?>

    <script>
        $.expr[":"].wordStarts = $.expr.createPseudo(function(arg) {
            return function( elem ) {
                let strPos = $(elem).text().toUpperCase().indexOf(arg.toUpperCase());
                if (strPos == -1) return false;
                else if (strPos == 0) return true;
                return $(elem).text().charAt(strPos - 1) == ' ';
            };
        });

        var noInput = true;

        $('input[name=address]').keyup(function () {
            if ($(this).val().length < 2) {
                resetSearch();
                noInput = true;
                return true;
            }
            noInput = false;

            $('table tbody td').hide();
            let searchVal = $(this).val();
            $('table tbody td:wordStarts(' + searchVal + ')').each(function() {
                $(this).show();
            });
        });

        function resetSearch() {
            if (noInput == true) return true;

            $('table td:hidden').show();
            noInput = true;
        }
    </script>
</body>
</html>