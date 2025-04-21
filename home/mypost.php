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

// 定义城市列表
$cities = array(
    'Hong Kong' => 'Hong Kong SAR',
    'Macao' => 'Macao SAR',
    'Shanghai' => 'Shanghai, China',
    'Beijing' => 'Beijing, China'
);

// 处理帖子发布
$post_error = "";
$post_success = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_post"])){
    $title = trim($_POST["title"]);
    $content = trim($_POST["content"]);
    $city = trim($_POST["city"]);
    
    // 验证输入
    if(empty($title)){
        $post_error = "请输入标题";
    } elseif(empty($content)){
        $post_error = "请输入内容";
    } elseif(empty($city)){
        $post_error = "请选择城市";
    } else {
        // 插入帖子
        $sql = "INSERT INTO posts (user_id, username, title, content, city) VALUES (?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "issss", $user_id, $username, $title, $content, $city);
            
            if(mysqli_stmt_execute($stmt)){
                $post_success = "帖子发布成功！";
                // 清空表单
                $title = $content = "";
            } else {
                $post_error = "发布失败，请重试。错误: " . mysqli_error($link);
            }
            
            mysqli_stmt_close($stmt);
        }
    }
}

// 获取用户的所有帖子
$posts = [];
$sql = "SELECT id, title, content, created_at FROM posts WHERE user_id = ? ORDER BY created_at DESC";

if($stmt = mysqli_prepare($link, $sql)){
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    
    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
        
        while($row = mysqli_fetch_assoc($result)){
            $posts[] = $row;
        }
    }
    
    mysqli_stmt_close($stmt);
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts - China Travel Starter Pack</title>
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
        .post-card {
            background-color: var(--white);
            border-radius: var(--radius-medium);
            padding: 2.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 2.5rem;
            border: 1px solid var(--neutral-95);
        }
        
        /* 表单样式 */
        .post-form {
            display: grid;
            gap: 2rem;
            margin-bottom: 2rem;
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
        
        .form-input, .form-textarea {
            padding: 1.25rem;
            border: 1px solid var(--neutral-90);
            border-radius: var(--radius-small);
            font-size: var(--fs-body-medium);
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }
        
        .form-input:focus, .form-textarea:focus {
            border-color: var(--primary-70);
            outline: none;
            box-shadow: 0 0 0 2px rgba(var(--primary-70-rgb), 0.1);
        }
        
        .form-textarea {
            min-height: 180px;
            resize: vertical;
            line-height: 1.5;
            padding: 1rem 1.25rem;
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
        
        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(var(--primary-70-rgb), 0.3);
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
        
        /* 帖子列表样式 */
        .post-list {
            display: grid;
            gap: 2rem;
        }
        
        .post-item {
            background-color: var(--white);
            border-radius: var(--radius-medium);
            padding: 2.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: 1px solid var(--neutral-95);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .post-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }
        
        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--neutral-95);
        }
        
        .post-title {
            font-size: var(--fs-title-medium);
            font-weight: var(--weight-semiBold);
            color: var(--neutral-20);
            margin: 0;
        }
        
        .post-date {
            font-size: var(--fs-label-medium);
            color: var(--neutral-60);
            background-color: var(--neutral-98);
            padding: 0.5rem 1rem;
            border-radius: var(--radius-small);
        }
        
        .post-content {
            font-size: var(--fs-body-medium);
            color: var(--neutral-30);
            line-height: 1.8;
            white-space: pre-line;
        }
        
        .post-author {
            font-size: var(--fs-label-medium);
            color: var(--primary-70);
            font-weight: var(--weight-semiBold);
            margin-bottom: 0.75rem;
            display: inline-block;
            background-color: rgba(var(--primary-70-rgb), 0.1);
            padding: 0.5rem 1rem;
            border-radius: var(--radius-small);
        }
        
        /* 标题样式 */
        .section-title {
            font-size: var(--fs-title-large);
            font-weight: var(--weight-semiBold);
            color: var(--neutral-20);
            margin: 3rem 0 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-70);
        }
        
        /* 无帖子提示样式 */
        .no-posts {
            background-color: var(--neutral-98);
            padding: 3rem;
            border-radius: var(--radius-medium);
            text-align: center;
            color: var(--neutral-60);
            border: 1px dashed var(--neutral-80);
        }
        
        /* 页面容器样式 */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        /* 响应式调整 */
        @media (max-width: 768px) {
            .post-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .container {
                padding: 1.5rem;
            }
            
            .post-card, .post-item {
                padding: 1.5rem;
            }
            
            .btn-primary {
                width: 100%;
                text-align: center;
            }
            
            .form-group:last-child {
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <main>
            <div class="container" style="padding-top: 2rem;">
                <h2 class="headline-large" style="margin-top: 2rem;">My Posts</h2>
                <p class="body-large">Share your travel experiences and tips with others.</p>
                
                <div class="post-card">
                    <h3 class="section-title">Create New Post</h3>
                    
                    <?php if(!empty($post_error)): ?>
                    <div class="alert alert-error">
                        <?php echo $post_error; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(!empty($post_success)): ?>
                    <div class="alert alert-success">
                        <?php echo $post_success; ?>
                    </div>
                    <?php endif; ?>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="post-form">
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" name="title" class="form-input" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="content" class="form-label">Content</label>
                            <textarea id="content" name="content" class="form-textarea"><?php echo isset($content) ? htmlspecialchars($content) : ''; ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="city" class="form-label">City</label>
                            <select id="city" name="city" class="form-input">
                                <option value="">Select a city</option>
                                <?php foreach($cities as $city_key => $city_value): ?>
                                <option value="<?php echo htmlspecialchars($city_key); ?>"><?php echo htmlspecialchars($city_value); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="submit_post" class="btn-primary">Publish Post</button>
                        </div>
                    </form>
                </div>
                
                <h3 class="section-title">Your Posts</h3>
                
                <?php if(empty($posts)): ?>
                <div class="no-posts">
                    <p>You haven't created any posts yet. Share your travel experiences above!</p>
                </div>
                <?php else: ?>
                <div class="post-list">
                    <?php foreach($posts as $post): ?>
                    <div class="post-item">
                        <div class="post-author">Posted by: <?php echo htmlspecialchars($username); ?></div>
                        <div class="post-header">
                            <h4 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h4>
                            <span class="post-date"><?php echo date('Y-m-d H:i', strtotime($post['created_at'])); ?></span>
                        </div>
                        <div class="post-content"><?php echo nl2br(htmlspecialchars($post['content'])); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
    

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