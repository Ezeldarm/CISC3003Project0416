<?php
// 引入数据库配置文件
require_once 'db_config.php';

$message = '';

// 检查 URL 中是否存在 token
if(isset($_GET['token']) && !empty($_GET['token'])){
    $token = $_GET['token'];

    // 准备一个 select 语句来查找带有该 token 的用户
    $sql = "SELECT id, email_verified FROM users WHERE verification_token = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        // 绑定变量到预处理语句作为参数
        mysqli_stmt_bind_param($stmt, "s", $param_token);
        
        // 设置参数
        $param_token = $token;
        
        // 执行预处理语句
        if(mysqli_stmt_execute($stmt)){
            // 存储结果
            mysqli_stmt_store_result($stmt);
            
            // 检查 token 是否存在
            if(mysqli_stmt_num_rows($stmt) == 1){
                // 绑定结果变量
                mysqli_stmt_bind_result($stmt, $user_id, $email_verified);
                mysqli_stmt_fetch($stmt);

                // 检查邮箱是否已经验证
                if($email_verified){
                    $message = '您的邮箱已经验证过了！';
                } else {
                    // 关闭 select 语句
                    mysqli_stmt_close($stmt);

                    // 准备一个 update 语句来更新邮箱验证状态并清除 token
                    $sql_update = "UPDATE users SET email_verified = true, verification_token = NULL WHERE id = ?";
                    
                    if($stmt_update = mysqli_prepare($link, $sql_update)){
                        // 绑定变量到预处理语句作为参数
                        mysqli_stmt_bind_param($stmt_update, "i", $param_id);
                        
                        // 设置参数
                        $param_id = $user_id;
                        
                        // 执行预处理语句
                        if(mysqli_stmt_execute($stmt_update)){
                            $message = '邮箱验证成功！您现在可以登录了。';
                        } else{
                            $message = '哎呀！更新验证状态时出了点问题。请稍后再试。';
                        }
                        // 关闭 update 语句
                        mysqli_stmt_close($stmt_update);
                    }
                }
            } else{
                $message = '无效的验证链接。';
            }
        } else{
            $message = '哎呀！执行查询时出了点问题。请稍后再试。';
        }
        // 如果之前的 select 语句没有关闭，在这里关闭
        if (isset($stmt) && mysqli_stmt_num_rows($stmt) == 1 && !$email_verified === false) { // Check if stmt exists and wasn't closed inside the 'else' block
             mysqli_stmt_close($stmt);
        }

    } else {
         $message = '哎呀！准备查询时出了点问题。请稍后再试。';
    }

} else {
    $message = '无效的请求。缺少验证令牌。';
}

// 关闭连接
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>邮箱验证 - CityLife指南</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .message-container {
            background: white;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h1 {
            color: #444;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            font-size: 1.1em;
            margin-bottom: 25px;
        }
        a.button {
            display: inline-block;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: opacity 0.3s;
        }
        a.button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1>邮箱验证结果</h1>
        <p><?php echo htmlspecialchars($message); ?></p>
        <a href="login.php" class="button">前往登录页面</a>
    </div>
</body>
</html>