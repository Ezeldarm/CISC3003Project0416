<?php
// 开启 session
session_start();

// 引入数据库配置文件
require_once 'db_config.php';

// 定义变量并用空值初始化
$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

// 处理 POST 请求
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // 验证用户名
    if(empty(trim($_POST["username"]))){ 
        $username_err = "请输入用户名.";
    } else{
        // 准备一个 select 语句
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // 绑定变量到预处理语句作为参数
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // 设置参数
            $param_username = trim($_POST["username"]);
            
            // 执行预处理语句
            if(mysqli_stmt_execute($stmt)){
                // 存储结果
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "该用户名已被占用.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "哎呀！出了点问题。请稍后再试.";
            }

            // 关闭语句
            mysqli_stmt_close($stmt);
        }
    }
    
    // 验证邮箱
    if(empty(trim($_POST["email"]))){ 
        $email_err = "请输入邮箱地址.";
    } elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
        $email_err = "请输入有效的邮箱地址.";
    } else{
        // 检查邮箱是否已被注册
        $sql = "SELECT id FROM users WHERE email = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST["email"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "该邮箱已被注册.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "哎呀！出了点问题。请稍后再试.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // 验证密码
    if(empty(trim($_POST["password"]))){ 
        $password_err = "请输入密码.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "密码至少需要6个字符.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // 验证确认密码
    if(empty(trim($_POST["confirm_password"]))){ 
        $confirm_password_err = "请确认密码.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "两次输入的密码不一致.";
        }
    }
    
    // 检查输入错误，再插入数据库
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // 准备一个 insert 语句
        $sql = "INSERT INTO users (username, email, password_hash, verification_token) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // 生成验证令牌
            $verification_token = bin2hex(random_bytes(50)); // 生成一个随机令牌

            // 绑定变量到预处理语句作为参数
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_email, $param_password, $param_token);
            
            // 设置参数
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // 创建密码哈希
            $param_token = $verification_token;
            
            // 执行预处理语句
            if(mysqli_stmt_execute($stmt)){
                // 注册成功
                // TODO: 发送验证邮件
                /*
                $verify_link = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/verify_email.php?token=" . $verification_token;
                $subject = "请验证您的邮箱地址 - CityLife指南";
                $message = "您好 " . $username . ",\n\n感谢您注册 CityLife指南！请点击以下链接验证您的邮箱地址：\n" . $verify_link . "\n\n如果您没有注册，请忽略此邮件。\n\n谢谢,\nCityLife指南团队";
                $headers = "From: no-reply@yourdomain.com"; // 修改为您的发件邮箱

                // 使用 mail() 函数发送邮件 (需要配置邮件服务器)
                // mail($email, $subject, $message, $headers);
                // 建议使用 PHPMailer 等库来更可靠地发送邮件
                */

                echo "<script>alert('注册成功！'); window.location.href='login.php';</script>";
                exit();
            } else{
                 echo "哎呀！出了点问题。错误: " . mysqli_error($link);
            }

            // 关闭语句
            mysqli_stmt_close($stmt);
        }
    }
    
    // 如果有错误，显示错误信息
    if(!empty($username_err) || !empty($email_err) || !empty($password_err) || !empty($confirm_password_err)){
        $error_message = $username_err . "\n" . $email_err . "\n" . $password_err . "\n" . $confirm_password_err;
        echo "<script>alert('注册失败：\n" . trim(preg_replace('/\s+/', ' ', $error_message)) . "'); window.history.back();</script>";
    }

    // 关闭连接
    mysqli_close($link);
} else {
    // 如果不是 POST 请求，重定向回注册页或首页
    header("location: register.html");
    exit();
}
?>