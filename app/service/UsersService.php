<?php
require_once '../repository/UsersRepo.php';
class UsersService
{
    private static $instance = null;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new UsersService();
        }
        return self::$instance;
    }
    public function doGet()
    {
        if (empty($_GET)) {
            $results = UsersRepo::getInstance()->getAllUsers();
            $data = ['totalPages' => count($results), 'responses' => $results];
            return $data;
        }
        return ['error' => 'Invalid request'];
    }
}
?>