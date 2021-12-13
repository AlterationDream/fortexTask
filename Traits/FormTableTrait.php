<?php
trait FormTableTrait {
    public static function formHTMLTable($tableData) : string
    {
        // Заголовок таблицы
        $table = '<table><thead><tr>';
        $columns = array_keys($tableData[array_key_first($tableData)]);
        foreach ($columns as $column) {
            $table .= '<th>' . $column . '</th>';
        }
        $table .= '</tr></thead>
    
    <tbody>';                               // Тело таблицы.
        foreach ($tableData as $row) {
            $table .= '<tr>';
            foreach ($row as $columnValue) {
                $table .= '<td>' . $columnValue  . '</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</tbody></table>';

        return $table;
    }
}
