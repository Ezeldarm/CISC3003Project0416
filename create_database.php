<?php
// 创建数据库和导入表结构的脚本

// 连接到MySQL服务器（不指定数据库名）
$link = mysqli_connect('localhost', 'root', '', '', 3307);

// 检查连接
if($link === false){
    die("ERROR: Could not connect to MySQL. " . mysqli_connect_error());
}

// 创建数据库
$sql = "CREATE DATABASE IF NOT EXISTS authentication_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
if(mysqli_query($link, $sql)){
    echo "数据库 'authentication_db' 创建成功！<br>";
} else {
    echo "创建数据库时出错: " . mysqli_error($link) . "<br>";
}

// 选择数据库
mysqli_select_db($link, 'authentication_db');

// 创建用户表
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email_verified BOOLEAN DEFAULT FALSE,
    verification_token VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

if(mysqli_query($link, $sql)){
    echo "用户表创建成功！<br>";
} else {
    echo "创建用户表时出错: " . mysqli_error($link) . "<br>";
}

// 创建密码重置表
$sql = "CREATE TABLE IF NOT EXISTS password_resets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    reset_token VARCHAR(255) NOT NULL,
    expiry_date TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_reset_token (reset_token)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

if(mysqli_query($link, $sql)){
    echo "密码重置表创建成功！<br>";
} else {
    echo "创建密码重置表时出错: " . mysqli_error($link) . "<br>";
}

// 创建邮箱验证表
$sql = "CREATE TABLE IF NOT EXISTS email_verification (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    verification_code VARCHAR(255) NOT NULL,
    expiry_date TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_verification_code (verification_code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

if(mysqli_query($link, $sql)){
    echo "邮箱验证表创建成功！<br>";
} else {
    echo "创建邮箱验证表时出错: " . mysqli_error($link) . "<br>";
}

// 创建帖子表
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

if(mysqli_query($link, $sql)){
    echo "帖子表创建成功！<br>";
} else {
    echo "创建帖子表时出错: " . mysqli_error($link) . "<br>";
}

echo "<p>所有数据库和表已创建完成！现在您可以正常使用系统了。</p>";
echo "<p><a href='home/index.php'>返回首页</a></p>";

// 关闭连接
mysqli_close($link);
?>