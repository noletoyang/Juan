<?php
require_once '../../includes/cors.php';
require_once '../../includes/Database.php';
require_once '../../includes/Response.php';

try {
    $db = Database::getInstance()->getConnection();
    $count = $db->query("
        SELECT COUNT(DISTINCT ip) 
        FROM visit_logs
    ")->fetchColumn();
    
    Response::json(['visits' => $count]);
} catch (Exception $e) {
    Response::error('获取访问统计失败: ' . $e->getMessage());
} 