<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); // 默认 XAMPP 用户名
define('DB_PASSWORD', ''); // 默认 XAMPP 密码为空
define('DB_NAME', 'authentication_db'); // 使用認證系統的數據庫
define('DB_PORT', 3307);

/* 连接 MySQL 数据库 */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

// 检查连接
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// 设置字符集为 utf8mb4
mysqli_set_charset($link, "utf8mb4");

?>