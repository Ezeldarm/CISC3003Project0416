<?php
// 引入数据库配置文件
require_once 'db_config.php';

$email = "";
$message = "";

// 处理 POST 请求
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = trim($_POST["email"]);

    if(empty($email)){
        $message = "请输入您的邮箱地址.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "请输入有效的邮箱地址.";
    } else {
        // 检查邮箱是否存在
        $sql = "SELECT id FROM users WHERE email = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = $email;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    // 邮箱存在，生成重置令牌和过期时间
                    $reset_token = bin2hex(random_bytes(50));
                    $reset_token_expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // 令牌1小时后过期

                    // 关闭之前的 select 语句
                    mysqli_stmt_close($stmt);

                    // 更新数据库中的重置令牌和过期时间
                    $sql_update = "UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?";
                    if($stmt_update = mysqli_prepare($link, $sql_update)){
                        mysqli_stmt_bind_param($stmt_update, "sss", $reset_token, $reset_token_expiry, $email);
                        
                        if(mysqli_stmt_execute($stmt_update)){
                            // 令牌更新成功，模拟发送邮件
                            /*
                            $reset_link = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/reset_password.php?token=" . $reset_token;
                            $subject = "密码重置请求 - CityLife指南";
                            $email_message = "您好,\n\n我们收到了您的密码重置请求。请点击以下链接设置新密码：\n" . $reset_link . "\n\n此链接将在1小时后失效。如果您没有请求重置密码，请忽略此邮件。\n\n谢谢,\nCityLife指南团队";
                            $headers = "From: no-reply@yourdomain.com"; // 修改为您的发件邮箱

                            // 使用 mail() 函数发送邮件 (需要配置邮件服务器)
                            // mail($email, $subject, $email_message, $headers);
                            // 建议使用 PHPMailer 等库
                            */
                            $message = "如果您的邮箱地址在我们系统中存在，一封包含密码重置链接的邮件已被发送。请检查您的收件箱（包括垃圾邮件文件夹）。";

                        } else {
                            $message = "哎呀！更新重置令牌时出错。请稍后再试。";
                        }
                        mysqli_stmt_close($stmt_update);
                    }
                } else {
                    // 邮箱不存在，但为了安全，显示同样的消息
                    $message = "如果您的邮箱地址在我们系统中存在，一封包含密码重置链接的邮件已被发送。请检查您的收件箱（包括垃圾邮件文件夹）。";
                     // 关闭 select 语句
                     mysqli_stmt_close($stmt);
                }
            } else {
                $message = "哎呀！执行查询时出错。请稍后再试。";
            }
             // Ensure statement is closed if an error occurred before closing
             if (isset($stmt) && $stmt instanceof mysqli_stmt) {
                 mysqli_stmt_close($stmt);
             }
        }
    }
    // 显示提示信息给用户
    echo "<script>alert('" . addslashes($message) . "'); window.location.href='forgot_password.html';</script>";
    exit();

    // 关闭连接
    mysqli_close($link);

} else {
    // 如果不是 POST 请求，重定向回忘记密码页
    header("location: forgot_password.html");
    exit();
}
?>