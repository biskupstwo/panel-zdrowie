<?php 

require_once PROJECT_ROOT . '/config/config.php';

class Database {
    private \PDO $dbconn;
    private \PDOStatement $statement;
    public function __construct()
    {
        global $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS;
        try {
            return $this->dbconn = new PDO('mysql:host='. $DB_HOST .';dbname='. $DB_NAME, $DB_USER, $DB_PASS);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public function dbstop() {
        $this->dbconn = null;
    }

    public function query($sql) {
        $this->statement = $this->dbconn->prepare($sql);
    }

    public function bind($parameter, $value, $type = null) {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($parameter, $value, $type);
    }

    public function execute() {
        return $this->statement->execute();
    }
    public function fetch() {
        return $this->statement->fetch();
    }
    public function fetchAll() {
        return $this->statement->fetchAll();
    }

    public function rowCount() {
        $this->execute();
        return $this->statement->rowCount();
    }
}