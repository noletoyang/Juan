<?php
require_once '../../includes/cors.php';
require_once '../../includes/Database.php';
require_once '../../includes/Response.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::error('方法不允许', 405);
    exit;
}

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    // 验证必填字段
    if (empty($data['name']) || empty($data['amount']) || empty($data['project']) || empty($data['date'])) {
        Response::error('缺少必要参数', 400);
        exit;
    }

    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("
        INSERT INTO donations (name, amount, project, comment, date, ip) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    
    $stmt->execute([
        $data['name'],
        $data['amount'],
        $data['project'],
        $data['comment'] ?? '',
        $data['date'],
        $_SERVER['REMOTE_ADDR']
    ]);

    Response::json(['message' => '添加成功']);
} catch (Exception $e) {
    Response::error('添加失败: ' . $e->getMessage());
} 