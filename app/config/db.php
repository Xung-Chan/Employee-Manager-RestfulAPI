<?php
class Db
{
    private $hostName = 'localhost';
    private $dbName = 'employee_manager_test';
    private $username = 'root';
    private $password = '';
    private static $conn = null;
    private function __construct()
    {
        try {
            self::$conn = new PDO("mysql:host=$this->hostName;dbname=$this->dbName", $this->username . $this->password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed:' . $e->getMessage();
        }
    }
    public static function getInstance()
    {
        if (self::$conn == null) {
            new Db();
        }
        return self::$conn;
    }
}

?>