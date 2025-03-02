<?php
require_once '../../includes/cors.php';
require_once '../../includes/Database.php';
require_once '../../includes/Response.php';

try {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("
        INSERT INTO visit_logs (ip, user_agent) 
        VALUES (?, ?)
    ");
    
    $stmt->execute([
        $_SERVER['REMOTE_ADDR'],
        $_SERVER['HTTP_USER_AGENT']
    ]);
    
    Response::json(['message' => '记录成功']);
} catch (Exception $e) {
    Response::error('记录访问失败: ' . $e->getMessage());
} 