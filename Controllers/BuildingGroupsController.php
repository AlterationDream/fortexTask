<?php require_once('../Database/db.php');
require_once('../Traits/FormTableTrait.php');

class BuildingGroupsController {
    use FormTableTrait;

    public static function getGroups() {
        $groups = self::getGroupsByContact();
        if (count($groups) == 0)
            return 'Ни одна группа зданий не объединена общим контактом.';
        return FormTableTrait::formHTMLTable($groups);
    }

    private static function getGroupsByContact()
    {
        $db = new DataBase();
        $db->connect();
        $sql = "SELECT address as 'Адреса', GROUP_CONCAT(phone SEPARATOR ', ') as 'Телефоны' FROM (
                    SELECT 
                       GROUP_CONCAT(DISTINCT buildings.Address SEPARATOR ', ') AS address, 
                        contacts.Contact AS phone,
    				    COUNT(persons.PersonID) AS cnt
                    FROM ((contacts INNER JOIN persons ON contacts.PersonID = persons.PersonID)
                    INNER JOIN buildings ON persons.BuildID = buildings.BuildID)
                    GROUP BY contacts.Contact
				    HAVING cnt > 1) AS raw_groups
                GROUP BY address";
        return $db->runSQL($sql);
    }

}