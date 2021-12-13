<?php require_once('../Database/db.php');
require_once('../Traits/FormTableTrait.php');

class IntervalsController {
    use FormTableTrait;

    public static function getClientIntervals($clientID) : string
    {
        $records = self::getClientRecords($clientID);
        if ($records['code'] == 'empty')
            return '<p>Ни один пользователь не работал с данным клиентом.</p>';
        $tableData = self::calculateIntervals($records['result']);
        return FormTableTrait::formHTMLTable($tableData);
    }

    protected static function getClientRecords($clientID) : array
    {
        $db = new DataBase();
        $db->connect();
        return $db->selectWhereOrderBy(
            'events',
            'ClientID',
            $clientID,
            ['Date', 'Time']
        );
    }

    protected static function calculateIntervals($query) : array
    {
        // Добавляем ещё один уровень порядковой иерархии в массиве
        // дат для дальнейшего их использования как интервалов.
        $intervalsRaw[]['start'] = array_shift($query);
        foreach ($query as $row) {
            $intervalsRaw[array_key_last($intervalsRaw)]['end'] = $row;
            $intervalsRaw[]['start'] = $row;
        }
        $intervalsRaw[array_key_last($intervalsRaw)]['end']['Date'] = date('Y-m-d');
        $intervalsRaw[array_key_last($intervalsRaw)]['end']['Time'] = date('h:i:s');
        $intervalsRaw[array_key_last($intervalsRaw)]['end']['UserID'] =
            $intervalsRaw[array_key_last($intervalsRaw)]['start']['UserID'];

        // Формируем данные для удобной разметки таблицы, соединяем соседние интервалы
        // одних и тех же пользователей, если такие имеются.
        $tableData = [];
        $intervalCounter = 0;
        foreach ($intervalsRaw as $key => $intervalRaw) {
            if ($intervalCounter == 0) {
                $newInterval =& $tableData[];
                $newInterval['UserID'] = $intervalRaw['start']['UserID'];
                $newInterval['DateStart'] = date_create($intervalRaw['start']['Date']);
            }
            if ($intervalRaw['start']['UserID'] == $intervalRaw['end']['UserID'] &&
                $key != array_key_last($intervalsRaw))
            {
                $intervalCounter++;
                continue;
            }

            // Вычисляем прошедшее количество дней и округляем в большую сторону, как
            // описано в примере (но не указано в задании).
            $newInterval['DateEnd'] = date_create($intervalRaw['end']['Date']);
            $timeElapsed = (array) date_diff($newInterval['DateStart'], $newInterval['DateEnd']);
            $newInterval['Days'] = (int) $timeElapsed['days'] + 1;

            // Возвращаем даты к необходимому формату таблицы.
            $newInterval['DateStart'] = $newInterval['DateStart']->format('Y-m-d');
            $newInterval['DateEnd'] = $newInterval['DateEnd']->format('Y-m-d');

            $intervalCounter = 0;
        }

        return $tableData;
    }
}
