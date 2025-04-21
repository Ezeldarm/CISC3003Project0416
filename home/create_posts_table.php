<?php
// 引入数据库配置文件
require_once 'db_config.php';

// 创建帖子表的SQL语句
$sql = "CREATE TABLE IF NOT EXISTS posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    username VARCHAR(50) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

// 执行SQL语句
if (mysqli_query($link, $sql)) {
    echo "帖子表创建成功！";
} else {
    echo "创建表时出错: " . mysqli_error($link);
}

// 关闭连接
mysqli_close($link);
?>