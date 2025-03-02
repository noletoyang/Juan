<?php
// 开启错误报告
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 记录访问日志
error_log("Accessing donations list API");

require_once '../../includes/cors.php';
require_once '../../includes/Database.php';
require_once '../../includes/Response.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    Response::error('方法不允许', 405);
    exit;
}

try {
    error_log("Processing request...");
    $db = Database::getInstance()->getConnection();
    $stmt = $db->query("
        SELECT id, name, amount, project, comment, date 
        FROM donations 
        WHERE status = 1 
        ORDER BY date DESC
    ");
    
    $result = $stmt->fetchAll();
    error_log("Query successful. Found " . count($result) . " records.");
    
    Response::json($result);
} catch (Exception $e) {
    error_log("Error in list.php: " . $e->getMessage());
    Response::error('获取数据失败: ' . $e->getMessage());
} 