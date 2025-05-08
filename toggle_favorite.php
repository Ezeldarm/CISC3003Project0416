<?php
session_start();
require_once 'db_config.php';

header('Content-Type: application/json');

// 检查用户是否已登录
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'not_logged_in']);
    exit;
}

// 获取POST数据
$city_name = isset($_POST['city_name']) ? trim($_POST['city_name']) : '';
$action = isset($_POST['action']) ? trim($_POST['action']) : '';

// 验证输入
if (empty($city_name) || empty($action)) {
    echo json_encode(['success' => false, 'error' => 'missing_parameters']);
    exit;
}

try {
    // 使用db_config.php中定义的常量
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
    $conn->set_charset("utf8mb4");

    if ($conn->connect_error) {
        throw new Exception("连接失败: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];

    if ($action === 'add') {
        // 添加收藏
        $stmt = $conn->prepare("INSERT IGNORE INTO favorite_cities (user_id, city_name) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $city_name);
    } else if ($action === 'remove') {
        // 移除收藏
        $stmt = $conn->prepare("DELETE FROM favorite_cities WHERE user_id = ? AND city_name = ?");
        $stmt->bind_param("is", $user_id, $city_name);
    } else {
        throw new Exception("无效的操作");
    }

    $stmt->execute();

    if ($stmt->affected_rows >= 0) {
        echo json_encode(['success' => true]);
    } else {
        throw new Exception("操作失败");
    }

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($conn)) {
        $conn->close();
    }
} 