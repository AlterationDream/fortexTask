<?php
class DataBase
{
    protected $dbConfig;
    protected $connection;

    public function __construct()
    {
        $this->dbConfig = parse_ini_file('../.env') ??
            die("DataBase connection could not be configured correctly.");
    }

    public function __destruct()
    {
        if ($this->connection instanceof mysqli)
            $this->connection->close();
    }

    public function connect() : void
    {
        $this->connection = new mysqli(
            $this->dbConfig["DB_HOST"],
            $this->dbConfig["DB_USERNAME"],
            $this->dbConfig["DB_PASSWORD"],
            $this->dbConfig["DB_DATABASE"]
        );
        if ($this->connection->connect_error)
            die("Connection to DataBase failed! " . $this->connection->connect_error);  //  TODO: May expand on.
    }

    public function selectWhereOrderBy(string $table, $whereColumn, $whereValue, array $orderBy) : array
    {
        $whereFormat = $whereColumn . "='" . $whereValue . "'";
        $orderByFormat = implode(', ', $orderBy);
        $sqlFormat = "SELECT * FROM %s WHERE %s ORDER BY %s";
        $sql = sprintf($sqlFormat, $table, $whereFormat, $orderByFormat);
        $result = $this->connection->query($sql);

        if ($result === FALSE)
            die('An error occurred while trying to select rows from a database. <br>' . $this->connection->error);
        if ($result->num_rows == 0)
            return ['code' => 'empty'];
        $resultArray = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        return ['code' => 200, 'result' => $resultArray];
    }

    public function insert(string $table, array $columns, array $valuesArray) : void
    {
        $columnsFormat = "(" . implode(", ", $columns) .")";
        $valuesFormat = "";
        foreach ($valuesArray as $key => $values) {
            if (is_array($values))
                $valuesFormat .= "('" . implode("', '", $values) . "')";
            else
                $valuesFormat .= "('" . $values . "')";
            if ($key != array_key_last($valuesArray)) $valuesFormat .= ", ";
        }

        $sqlFormat = "INSERT INTO %s %s VALUES %s";
        $sql = sprintf($sqlFormat, $table, $columnsFormat, $valuesFormat);
        if ($this->connection->query($sql) === FALSE)
            die('An error occurred while trying to insert rows in a database. <br>' . $this->connection->error);
    }

    public function runSQL($sql) : array
    {
        $result = $this->connection->query($sql);
        if ($result === FALSE)
            die('An error occurred while trying to run a raw query. <br>' . $this->connection->error);
        $resultArray = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        return $resultArray;
    }

    public function runVoidSQL($sql) : void
    {
        if ($this->connection->query($sql) === FALSE)
            die('An error occurred while trying to run a raw query. <br>' . $this->connection->error);
    }
}