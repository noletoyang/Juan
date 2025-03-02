<?php
require_once '../../includes/cors.php';
require_once '../../includes/Database.php';
require_once '../../includes/Response.php';

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (empty($data['id'])) {
        Response::error('缺少必要参数', 400);
        exit;
    }

    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("UPDATE donations SET status = 0 WHERE id = ?");
    $stmt->execute([$data['id']]);
    
    Response::json(['message' => '删除成功']);
} catch (Exception $e) {
    Response::error('删除失败: ' . $e->getMessage());
} 