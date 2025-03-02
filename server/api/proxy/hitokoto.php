<?php
require_once '../../includes/cors.php';
require_once '../../includes/Response.php';

try {
    $response = file_get_contents('https://v1.hitokoto.cn/?c=i&c=d&c=k');
    $data = json_decode($response, true);
    Response::json($data);
} catch (Exception $e) {
    Response::error('获取名言失败: ' . $e->getMessage());
} 