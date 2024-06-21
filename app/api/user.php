<?php
header('Content-Type: application/json');
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $conn = Db::getInstance();
        if (empty($_GET)) {
            $query = 'SELECT * FROM users';
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $results = ["totalPages" => count($rows), "response" => $rows];
            echo json_encode($results);
            exit();
        }
        echo json_encode(['error' => 'Invalid request']);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $value = [$_POST['fullName'], $_POST['username'], $_POST['email'], $_POST['address'], $_POST['phone'], $_POST['website'], $_POST['company']];
        $conn = Db::getInstance();
        $paramaters = ['fullName', 'username', 'email', 'address', 'phone', 'website', 'company'];
        foreach ($paramaters as $paramater) {
            if (!isset($_POST[$paramater])) {
                echo json_encode(['error' => 'Missing parameter ' . $paramater]);
                exit;
            }
        }
        $query = 'insert into users(fullName, username, email, address, phone, website, company) values(?,?,?,?,?,?,?)';
        $stmt = $conn->prepare($query);
        $stmt->execute($value);
        echo json_encode(['message' => 'User created successfully']);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>