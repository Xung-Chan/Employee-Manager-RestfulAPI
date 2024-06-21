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
            $data = [];
            // foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            //     $data[] = [
            //         'id' => $row['id'],
            //         'fullName' => $row['fullName'],
            //         'username' => $row['username'],
            //         'email' => $row['email'],
            //         'address' => $row['address'],
            //         'phone' => $row['phone'],
            //         'website' => $row['website'],
            //         'company' => $row['company']
            //     ];
            // }
            // return $data;
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo json_encode(array('Error: ' . $e->getMessage()));
        }
    }
}
?>