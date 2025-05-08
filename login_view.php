<!DOCTYPE html>
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0..1,0">
    <link rel="stylesheet" href="./assets/css/login-style.css">
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
                <input type="text" id="login_identifier" name="login_identifier" placeholder="Input username or email" value="<?php echo htmlspecialchars($login_identifier); ?>" required>
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
        <div class="footer-bottom">
            <div class="container">
                <p class="copyright body-medium">
                    &copy; 2025 WebMaster Partners. All rights reserved. <br>
                    CISC3003 Web Programming - 2025: Pair 12 DC328536 ZHONG YUZHANG | DC326958 XIE YI | Pair 10 DC326264 CHEANG NGOU HIN | DC325022 PAN YANGSHEN
                </p>
            </div>
        </div>
    </footer>
</body>
</html>