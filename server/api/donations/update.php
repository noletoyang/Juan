<?php
require_once '../../includes/cors.php';
require_once '../../includes/Database.php';
require_once '../../includes/Response.php';

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (empty($data['id']) || empty($data['name']) || empty($data['amount']) || empty($data['project']) || empty($data['date'])) {
        Response::error('缺少必要参数', 400);
        exit;
    }

    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("
        UPDATE donations 
        SET name = ?, amount = ?, project = ?, comment = ?, date = ?
        WHERE id = ?
    ");
    
    $stmt->execute([
        $data['name'],
        $data['amount'],
        $data['project'],
        $data['comment'] ?? '',
        $data['date'],
        $data['id']
    ]);

    Response::json(['message' => '更新成功']);
} catch (Exception $e) {
    Response::error('更新失败: ' . $e->getMessage());
} 