<?php
require_once '../config/DB.php';
class UsersRepo
{
    private static $instance = null;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new UsersRepo();
        }
        return self::$instance;
    }
    public function getAllUsers()
    {
        try {
            $conn = DB::getInstance();
            $stmt = $conn->prepare('select * from users');
            $stmt->execute();
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ['responses' => $datas];
        } catch (Exception $e) {
            echo json_encode(array('Error: ' . $e->getMessage()));
        }
    }
    public function getUsersByPage($page)
    {
        try {
            $conn = DB::getInstance();
            $offset = ((int) $page - 1) * 5;
            $query = 'SELECT * FROM users ORDER by id ASC LIMIT 5 OFFSET ' . $offset;
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ['totalPages' => $this->getTotalPages(), 'responses' => $datas];
        } catch (Exception $e) {
            return json_encode(array('Error:' . $e->getMessage()));
        }
    }
    private function getTotalPages($condition = '')
    {
        $query = 'SELECT COUNT(*) AS total FROM users ' . $condition;
        $conn = DB::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $totalRow = $data[0]['total'];
        return ceil($totalRow / 5);
    }
    public function addUser($values)
    {
        $query = 'INSERT INTO users(fullName, username, email, address, phone, website, company) values (?,?,?,?,?,?,?);';
        $conn = DB::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->execute($values);
        return ['Successfully' => 'User inserted with id:' . $this->getLastestInserted()];
    }
    private function getLastestInserted()
    {
        $conn = DB::getInstance();
        $stmt = $conn->prepare('SELECT id from users ORDER by ID DESC LIMIT 1;');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data[0]['id'];
    }
    public function removeUser($id)
    {
        $conn = DB::getInstance();
        $stmt = $conn->prepare('DELETE FROM users where id = ' . $id);
        $stmt->execute();
        return ['Successfully' => 'User deleted id:' . $id];
    }
}
?>