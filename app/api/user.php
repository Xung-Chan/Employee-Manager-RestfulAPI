<?php

header('Content-Type: application/json');
require_once '../service/UsersService.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $service = UsersService::getInstance();
        $data = $service->doGet();
        echo json_encode($data);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        echo json_encode(UsersService::getInstance()->doPost());
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        echo json_encode(UsersService::getInstance()->doDelete());
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>