<?php
// 开启 session
session_start();

// 检查用户是否已登录，如果没有则重定向到登录页面
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// 引入数据库配置文件
require_once 'db_config.php';

// 获取用户信息
$user_id = $_SESSION["id"];
$username = $_SESSION["username"];
$email = $_SESSION["email"] ?? "";

// 如果提交了表单更新用户信息
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_profile"])){
    // 处理表单提交
    $new_username = trim($_POST["username"]);
    $new_email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $error_message = "";
    
    // 验证输入
    if(empty($new_username)){
        $error_message = "请输入用户名";
    } elseif(empty($new_email)){
        $error_message = "请输入邮箱";
    } elseif(!filter_var($new_email, FILTER_VALIDATE_EMAIL)){
        $error_message = "邮箱格式无效";
    } elseif(empty($password)){
        $error_message = "请输入密码以确认更改";
    } else {
        // 验证密码
        $sql = "SELECT password_hash FROM users WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // 密码验证成功，更新用户信息
                            $update_sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
                            if($update_stmt = mysqli_prepare($link, $update_sql)){
                                mysqli_stmt_bind_param($update_stmt, "ssi", $new_username, $new_email, $user_id);
                                if(mysqli_stmt_execute($update_stmt)){
                                    // 更新成功，更新会话变量
                                    $_SESSION["username"] = $new_username;
                                    $_SESSION["email"] = $new_email;
                                    $username = $new_username;
                                    $email = $new_email;
                                    $success_message = "个人信息已成功更新";
                                } else {
                                    $error_message = "更新失败，请重试";
                                }
                                mysqli_stmt_close($update_stmt);
                            }
                        } else {
                            $error_message = "密码不正确";
                        }
                    }
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - China Travel Starter Pack</title>
    <meta name="title" content="China Travel Starter Pack">
    <meta name="description" content="This is a realestate website devloped by Group 02">
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0..1,0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/script.js" defer></script>
    <style>
        /* CSS变量 */
        :root {
            --primary-70-rgb: 33, 133, 208; /* 蓝色主题色的RGB值 */
        }
        /* 卡片样式 */
        .profile-card {
            background-color: var(--white);
            border-radius: var(--radius-medium);
            padding: 2.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 2.5rem;
            border: 1px solid var(--neutral-95);
        }
        
        /* 表单样式 */
        .profile-form {
            display: grid;
            gap: 2rem;
            max-width: 100%;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .form-label {
            font-size: var(--fs-label-large);
            font-weight: var(--weight-semiBold);
            color: var(--neutral-30);
        }
        
        .form-input {
            padding: 1.25rem;
            border: 1px solid var(--neutral-90);
            border-radius: var(--radius-small);
            font-size: var(--fs-body-medium);
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }
        
        .form-input:focus {
            border-color: var(--primary-70);
            outline: none;
            box-shadow: 0 0 0 2px rgba(var(--primary-70-rgb), 0.1);
        }
        
        /* 按钮样式 */
        .btn-primary {
            background-color: var(--primary-70);
            color: var(--white);
            border: none;
            border-radius: var(--radius-small);
            padding: 1.25rem 2.5rem;
            font-size: var(--fs-label-large);
            font-weight: var(--weight-semiBold);
            cursor: pointer;
            transition: all 0.3s ease;
            width: auto;
            align-self: flex-start;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-80);
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        
        /* 提示框样式 */
        .alert {
            padding: 1.25rem;
            border-radius: var(--radius-small);
            margin-bottom: 2rem;
            font-weight: var(--weight-medium);
        }
        
        .alert-error {
            background-color: #ffebee;
            color: var(--error-100);
            border: 1px solid #ffcdd2;
        }
        
        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }
        
        /* 标题样式 */
        .headline-large {
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 0.75rem;
        }
        
        .headline-large::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-70);
        }
        
        /* 页面容器样式 */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        /* 响应式调整 */
        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
            }
            
            .profile-card {
                padding: 1.5rem;
            }
            
            .btn-primary {
                width: 100%;
            }
        }
        
        /* 改进表单元素间距 */
        .form-input {
            padding: 1rem 1.25rem;
            line-height: 1.5;
        }
        
        /* 改进按钮悬停效果 */
        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(var(--primary-70-rgb), 0.3);
        }
        
        /* 改进表单组件间距 */
        .form-group:last-child {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <main>
            <div class="container" style="padding-top: 2rem;">
                <h2 class="headline-large" style="margin-top: 2rem;">My Profile</h2>
                <p class="body-large">Here you can view and edit your profile information.</p>
                
                <div class="profile-card">
                    <?php if(isset($error_message) && !empty($error_message)): ?>
                    <div class="alert alert-error">
                        <?php echo $error_message; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(isset($success_message)): ?>
                    <div class="alert alert-success">
                        <?php echo $success_message; ?>
                    </div>
                    <?php endif; ?>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="profile-form">
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-input" value="<?php echo htmlspecialchars($username); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-input" value="<?php echo htmlspecialchars($email); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="form-label">Current Password (to confirm changes)</label>
                            <input type="password" id="password" name="password" class="form-input">
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="update_profile" class="btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <?php include 'footer.php'; ?>

    <script>
        // 确保页脚正确显示
        document.addEventListener('DOMContentLoaded', function() {
            // 调整主内容区域的最小高度，确保页面内容足够长以便页脚显示在底部
            const mainContent = document.querySelector('.main-content');
            const windowHeight = window.innerHeight;
            const headerHeight = document.querySelector('header') ? document.querySelector('header').offsetHeight : 0;
            const footerHeight = document.querySelector('.footer') ? document.querySelector('.footer').offsetHeight : 0;
            
            if (mainContent) {
                mainContent.style.minHeight = `${windowHeight - headerHeight - footerHeight}px`;
                // 添加底部边距，确保内容不会被页脚遮挡
                mainContent.style.paddingBottom = `${footerHeight + 20}px`;
            }
        });
    </script>
</body>
</html>