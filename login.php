<?php
// 开启 session
session_start();

// 如果用户已登录，重定向到首页
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// 引入数据库配置文件
require_once 'db_config.php';

// 定义变量并用空值初始化
$login_identifier = $password = "";
$login_identifier_err = $password_err = $login_err = "";
$error_message = "";

// 如果存在登录错误信息，获取并清除session中的错误信息
if (isset($_SESSION['login_error'])) {
    $error_message = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}

// 如果是GET请求，显示登录页面
if($_SERVER["REQUEST_METHOD"] != "POST") {
    ?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        header {
            background: var(--primary-40);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
        }

        .logo a {
            color: white;
            text-decoration: none;
        }
        
        .auth-buttons .btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            margin-left: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .auth-buttons .btn:hover {
            background: rgba(255,255,255,0.3);
        }

        .login-container {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-form {
            background: white;
            padding: 2.5rem 3rem;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
            font-size: 16px;
        }

        .login-form h2 {
            margin-bottom: 1.5rem;
            color: #444;
            font-size: 1.8rem;
        }

        .error-message {
            color: #ff4444;
            margin-bottom: 1rem;
            padding: 0.5rem;
            background: #ffe6e6;
            border-radius: 4px;
            text-align: left;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 1rem 1.2rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1.1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #6e8efb;
        }

        .submit-btn {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            width: 100%;
            transition: opacity 0.3s;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            opacity: 0.9;
        }

        .extra-links {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
            display: flex;
            justify-content: space-between;
        }

        .extra-links a {
            color: #6e8efb;
            text-decoration: none;
        }

        .extra-links a:hover {
            text-decoration: underline;
        }

        footer {
            background: #333;
            color: #ccc;
            padding: 1.5rem 0;
            text-align: center;
            font-size: 0.9rem;
            margin-top: auto;
        }

        @media (max-width: 480px) {
            header {
                flex-direction: column;
                padding: 1rem;
            }
            .logo {
                margin-bottom: 1rem;
            }
            .login-form {
                padding: 2rem 1.5rem;
            }
            .login-form h2 {
                font-size: 1.5rem;
            }
        }
    </style>
    <style>
        .login-container {
            margin-top: 80px;
        }
        .register-btn {
            font-size: 1.4rem;
            padding: 0rem 1rem;
        }
    </style>
    <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- 
    - google icon link
  -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0..1,0">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/login-style.css">

  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js" defer></script>
</head>
<body>
    <header class="header" data-header>
    <div class="container">

      <a href="index.php" class="logo">
        China Travel<br>
        Starter Pack
      </a>

      <div class="auth-buttons">
            <button class="btn login-btn" onclick="location.href='register.php'">Register</button>
        </div>

      <!-- <nav class="navbar" data-navbar>
        <div class="navbar-wrapper" style="margin-left: auto;">
            <button class="btn register-btn btn-fill label-medium" onclick="location.href='register.html'">Register</button>
        </div>

      </nav> -->

      <!-- <button class="nav-toggle-btn icon-btn" aria-label="toggle navbar" data-nav-toggler>
        <span class="material-symbols-rounded open" aria-hidden="true">menu</span>

        <span class="material-symbols-rounded close" aria-hidden="true">close</span>
      </button> -->

    </div>
  </header>

    <div class="login-container">
        <form action="login.php" method="post" class="login-form">
            <h2>Login</h2>
            <?php if (!empty($error_message) && trim($error_message) !== ''): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
            <?php endif; ?>
            
            <div class="form-group">
                <label for="login_identifier">Account</label>
                <input type="text" id="login_identifier" name="login_identifier" placeholder="Input username or email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Input password" required>
            </div>

            <button type="submit" class="submit-btn">Login</button>

            <div class="extra-links">
                <a href="forgot_password.html">Forget password?</a>
                <a href="register.html">Register new account</a>
            </div>
        </form>
    </div>

    <footer>
        <!-- <p>&copy; 2024 CityLife指南. All rights reserved.</p> -->
        <div class="footer-bottom">
            <div class="container">
    
            <p class="copyright body-medium">
                &copy; 2025 WebMaster Partners. All rights reserved. <br> CISC3003 Web Programming - 2025: Pair 12 DC328536 ZHONG YUZHANG | DC326958 XIE YI | Pair 10 DC326264 CHEANG NGOU HIN | DC325022 PAN YANGSHEN
            </p>
    
            </div>
        </div>
    </footer>
</body>
</html><?php
    exit;
}

// 处理 POST 请求
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // 检查登录标识符（用户名或邮箱）是否为空
    if(empty(trim($_POST["login_identifier"]))){ 
        $login_identifier_err = "请输入用户名或邮箱.";
    }
    // 检查密码是否为空
    if(empty(trim($_POST["password"]))){ 
        $password_err = "请输入密码.";
    }

    // 如果输入都有效
    if(empty($login_identifier_err) && empty($password_err)){
        $login_identifier = trim($_POST["login_identifier"]);
        $password = trim($_POST["password"]);

        // 准备一个 select 语句，尝试通过用户名或邮箱查找用户
        $sql = "SELECT id, username, email, password_hash, email_verified FROM users WHERE username = ? OR email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // 绑定变量到预处理语句作为参数
            mysqli_stmt_bind_param($stmt, "ss", $param_identifier, $param_identifier);
            
            // 设置参数
            $param_identifier = $login_identifier;
            
            // 执行预处理语句
            if(mysqli_stmt_execute($stmt)){
                // 存储结果
                mysqli_stmt_store_result($stmt);
                
                // 检查用户是否存在，如果存在，验证密码
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // 绑定结果变量
                    mysqli_stmt_bind_result($stmt, $id, $username, $email, $hashed_password, $email_verified);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // 密码正确，启动一个新会话
                            session_regenerate_id(); // 防止会话固定攻击
                            
                            // 存储数据到 session 变量
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["email"] = $email;
                            $_SESSION["email_verified"] = $email_verified; // 存储邮箱验证状态
                            $_SESSION["user_id"] = $id; // 添加user_id到session
                            
                            // 检查是否有重定向URL
                            if(isset($_SESSION['redirect_after_login'])) {
                                $redirect_url = $_SESSION['redirect_after_login'];
                                unset($_SESSION['redirect_after_login']);
                                header("location: " . $redirect_url);
                            } else {
                                header("location: index.php");
                            }
                            exit();

                        } else{
                            // 密码不正确
                            $login_err = "用户名/邮箱或密码无效.";
                        }
                    }
                } else{
                    // 用户不存在
                    $login_err = "用户名/邮箱或密码无效.";
                }
            } else{
                echo "哎呀！出了点问题。请稍后再试.";
            }

            // 关闭语句
            mysqli_stmt_close($stmt);
        }
    }
    
    // 如果有错误，将错误信息存储到session并重新显示登录页面
    if(!empty($login_identifier_err) || !empty($password_err) || !empty($login_err)){
        $error_message = trim($login_identifier_err . " " . $password_err . " " . $login_err);
        include(__FILE__);
        exit();
    }

    // 关闭连接
    mysqli_close($link);
} else {
    // 如果不是 POST 请求，重定向回登录页
    header("location: login.php");
    exit();
}
?>