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
            return UsersRepo::getInstance()->getAllUsers();
        }
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            return UsersRepo::getInstance()->getUsersByPage($page);
        }
        return ['error' => 'Invalid request'];
    }
    public function doPost()
    {
        $fullParameters = ['fullName', 'username', 'email', 'address', 'phone', 'company', 'website'];
        $checkParameters = $this->isFullParameters($fullParameters);
        if ($checkParameters != 1) {
            return $checkParameters;
        }
        $values = $this->getValues($fullParameters);
        return UsersRepo::getInstance()->addUser($values);
    }
    private function isFullParameters($fullParameters)
    {

        foreach ($fullParameters as $para) {
            if (!isset($_POST[$para]))
                return ['error' => 'Missing parameter' . $para];
        }
        return true;
    }
    private function getValues($fullParameters)
    {
        $values = [];
        foreach ($fullParameters as $para) {
            $values[] = $_POST[$para];
        }
        return $values;
    }
    public function doDelete()
    {
        try {
            $input = file_get_contents('php://input');
            $data = json_decode($input);

            if (!isset($data->id)) {
                echo json_encode(['error' => 'Missing parameter id']);
                exit;
            }
            return UsersRepo::getInstance()->removeUser($data->id);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
?>