<?php
require_once '../../includes/cors.php';
require_once '../../includes/Database.php';
require_once '../../includes/Response.php';

try {
    $db = Database::getInstance()->getConnection();
    
    // 获取最近7天的数据
    $sevenDaysAgo = date('Y-m-d', strtotime('-6 days'));
    error_log("Fetching stats from: " . $sevenDaysAgo);

    $stmt = $db->prepare("
        SELECT 
            DATE(date) as date,
            SUM(amount) as total_amount
        FROM donations 
        WHERE status = 1 
        AND DATE(date) >= ?
        GROUP BY DATE(date)
        ORDER BY date ASC
    ");
    $stmt->execute([$sevenDaysAgo]);
    $dailyStats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    error_log("Daily stats: " . json_encode($dailyStats));
    
    // 获取其他统计数据
    $stats = [
        'total' => $db->query("SELECT SUM(amount) FROM donations WHERE status = 1")->fetchColumn() ?: 0,
        'count' => $db->query("SELECT COUNT(*) FROM donations WHERE status = 1")->fetchColumn(),
        'max' => $db->query("SELECT MAX(amount) FROM donations WHERE status = 1")->fetchColumn() ?: 0,
        'monthly' => $db->query("
            SELECT SUM(amount) 
            FROM donations 
            WHERE status = 1 
            AND MONTH(date) = MONTH(CURRENT_DATE())
            AND YEAR(date) = YEAR(CURRENT_DATE())
        ")->fetchColumn() ?: 0,
        'daily' => $dailyStats
    ];
    error_log("Full stats: " . json_encode($stats));
    
    Response::json($stats);
} catch (Exception $e) {
    error_log("Error in stats.php: " . $e->getMessage());
    Response::error('获取统计数据失败: ' . $e->getMessage());
} 