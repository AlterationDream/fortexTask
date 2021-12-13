<?php require_once('../Database/db.php');
require_once('../Traits/FormTableTrait.php');

class BuildingsListController {
    use FormTableTrait;

    public static function getBuildingsList() : string
    {
        $db = new DataBase();
        $db->connect();
        $sql = "SELECT Address as 'Адреса' FROM other_buildings ORDER BY Address";
        return FormTableTrait::formHTMLTable(
            $db->runSQL($sql)
        );
    }
}