<?php
// 引入数据库配置文件
require_once 'db_config.php';

$token = $new_password = $confirm_password = "";
$password_err = $confirm_password_err = $token_err = "";
$message = '';
$status = 'error'; // Default status for messages

// 处理 POST 请求
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $token = trim($_POST["token"]);

    // 验证 token 是否存在
    if(empty($token)){
        $token_err = "无效或丢失的重置令牌.";
    }

    // 验证新密码
    if(empty(trim($_POST["new_password"]))){ 
        $password_err = "请输入新密码.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $password_err = "密码至少需要6个字符.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // 验证确认密码
    if(empty(trim($_POST["confirm_password"]))){ 
        $confirm_password_err = "请确认新密码.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "两次输入的密码不一致.";
        }
    }

    // 如果没有输入错误
    if(empty($token_err) && empty($password_err) && empty($confirm_password_err)){
        // 检查 token 是否有效且未过期
        $sql = "SELECT id FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_token);
            $param_token = $token;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Token 有效，获取用户 ID
                    mysqli_stmt_bind_result($stmt, $user_id);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt); // 关闭 select 语句

                    // 更新密码并清除 token
                    $sql_update = "UPDATE users SET password_hash = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?";
                    if($stmt_update = mysqli_prepare($link, $sql_update)){
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt_update, "si", $hashed_password, $user_id);

                        if(mysqli_stmt_execute($stmt_update)){
                            // 密码重置成功
                            $message = '密码已成功重置！您现在可以使用新密码登录了。';
                            $status = 'success';
                            // 重定向到登录页面并附带成功消息
                            header("location: login.html?message=" . urlencode($message) . "&status=success");
                            exit();
                        } else {
                            $message = "哎呀！更新密码时出错。请稍后再试。";
                        }
                        mysqli_stmt_close($stmt_update);
                    }
                } else {
                    // Token 无效或已过期
                    $message = "无效或已过期的密码重置链接。请重新请求。";
                    mysqli_stmt_close($stmt); // 关闭 select 语句
                }
            } else {
                $message = "哎呀！执行查询时出错。请稍后再试。";
            }
             // Ensure statement is closed if an error occurred before closing
             if (isset($stmt) && $stmt instanceof mysqli_stmt) {
                 mysqli_stmt_close($stmt);
             }
        }
    } else {
        // 组合错误信息
        $message = $token_err . " " . $password_err . " " . $confirm_password_err;
    }

    // 如果出错，重定向回重置页面并显示错误
    if($status === 'error'){
        // 确保关闭连接
        mysqli_close($link);
        header("location: reset_password.html?token=" . urlencode($token) . "&message=" . urlencode(trim($message)) . "&status=error");
        exit();
    }

    // 关闭连接
    mysqli_close($link);

} else {
    // 如果不是 POST 请求，检查是否有 token 参数，有则显示表单，否则重定向
    if(isset($_GET['token']) && !empty($_GET['token'])){
        // 验证 token 是否存在且有效，防止直接访问 reset_password.php
        require_once 'db_config.php';
        $token = $_GET['token'];
        $sql = "SELECT id FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $token);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) != 1){
                    // Token 无效或过期，重定向到提示页面或登录页
                     mysqli_stmt_close($stmt);
                     mysqli_close($link);
                     header("location: forgot_password.html?message=" . urlencode('无效或已过期的密码重置链接。') . "&status=error");
                     exit();
                }
                 mysqli_stmt_close($stmt);
            } else {
                 mysqli_close($link);
                 header("location: forgot_password.html?message=" . urlencode('验证链接时出错。') . "&status=error");
                 exit();
            }
        } else {
             mysqli_close($link);
             header("location: forgot_password.html?message=" . urlencode('准备验证链接时出错。') . "&status=error");
             exit();
        }
         mysqli_close($link);
        // Token 有效，允许加载 reset_password.html (通过 include 或直接访问)
        // 这里我们假设用户通过链接访问 reset_password.html，该页面已包含 token
        // 因此，如果直接访问 reset_password.php (GET)，且 token 有效，可以重定向到带 token 的 html 页面
        header("location: reset_password.html?token=" . urlencode($token));
        exit();

    } else {
        // 没有 token，重定向到忘记密码页面
        header("location: forgot_password.html");
        exit();
    }
}
?>