<?php
class Response {
    public static function json($data, $success = true, $code = 200) {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
        
        echo json_encode([
            'success' => $success,
            'data' => $data,
            'timestamp' => time()
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function error($message, $code = 500) {
        self::json(['message' => $message], false, $code);
    }
} 