<?php
// 检查用户是否已登录
session_start();
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>城市生活指南 - 发现本地生活</title>
    <style>
        /* 全局样式 */
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
        }
        
        /* 头部样式 */
        header {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
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
        
        /* 搜索区域 */
        .search-hero {
            background: url('https://images.unsplash.com/photo-1508804185872-d7badad00f7d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
            background-size: cover;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .search-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
        }
        
        .search-container {
            position: relative;
            width: 60%;
            max-width: 800px;
            z-index: 1;
        }
        
        .search-container h2 {
            color: white;
            margin-bottom: 1rem;
            text-align: center;
            font-size: 2rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }
        
        .search-bar {
            display: flex;
        }
        
        .search-bar input {
            flex: 1;
            padding: 1rem;
            border: none;
            border-radius: 30px 0 0 30px;
            font-size: 1rem;
            outline: none;
        }
        
        .search-bar button {
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 0 1.5rem;
            border-radius: 0 30px 30px 0;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s;
        }
        
        .search-bar button:hover {
            background: #ff5252;
        }
        
        /* 城市板块 */
        .cities-section {
            padding: 3rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 2rem;
            color: #444;
        }
        
        .cities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .city-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        
        .city-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .city-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }
        
        .city-info {
            padding: 1.2rem;
        }
        
        .city-info h3 {
            margin-bottom: 0.5rem;
            color: #333;
        }
        
        .city-info p {
            color: #666;
            font-size: 0.9rem;
        }
        
        /* 分类导航 */
        .categories {
            background: white;
            padding: 1.5rem 2rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .categories h3 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #555;
        }
        
        .category-tags {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .tag {
            background: #f0f4f8;
            padding: 0.6rem 1.2rem;
            border-radius: 20px;
            font-size: 0.9rem;
            color: #4a6b8b;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .tag:hover {
            background: #e0e8f0;
            color: #3a5a78;
        }
        
        /* 响应式设计 */
        @media (max-width: 768px) {
            .search-container {
                width: 90%;
            }
            
            .cities-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }
        
        @media (max-width: 480px) {
            header {
                flex-direction: column;
                padding: 1rem;
            }
            
            .logo {
                margin-bottom: 1rem;
            }
            
            .search-hero {
                height: 250px;
            }
            
            .search-container h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">CityLife Guide</div>
        <div class="auth-buttons">
            <?php 
            //session_start(); // Start the session at the beginning
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <span style="margin-right: 1rem; color: white;">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                <button class="btn logout-btn" onclick="location.href='logout.php'">Exit</button>
            <?php else: ?>
                <button class="btn login-btn" onclick="location.href='login.php'">Login</button>
                <button class="btn register-btn" onclick="location.href='register.html'">Register</button>
            <?php endif; ?>
        </div>
    </header>
    
    <div class="search-hero">
        <div class="search-container">
            <h2>Discover the city life that suits you best</h2>
            <div class="search-bar">
                <input type="text" placeholder="Search for a city, region or keyword...">
                <button>Search</button>
            </div>
        </div>
    </div>
    
    <section class="cities-section">
        <h2 class="section-title">热门城市指南</h2>
        <div class="cities-grid">
            <!-- 上海 -->
            <div class="city-card" onclick="location.href='city.php?city=shanghai'">
                <img src="https://images.unsplash.com/photo-1508804185872-d7badad00f7d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="上海">
                <div class="city-info">
                    <h3>Shanghai</h3>
                    <p>A guide to living in a cosmopolitan city</p>
                </div>
            </div>
            
            <!-- 北京 -->
            <div class="city-card" onclick="location.href='city.php?city=beijing'">
                <img src="https://images.unsplash.com/photo-1547981609-4b6bfe67ca0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="北京">
                <div class="city-info">
                    <h3>Beijing</h3>
                    <p>Fusion of ancient capital culture with modern life</p>
                </div>
            </div>
            
            <!-- 深圳 -->
            <div class="city-card" onclick="location.href='city.php?city=shenzhen'">
                <img src="https://images.unsplash.com/photo-1609515602287-8470b8d9ac11?q=80&w=3269&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="深圳">
                <div class="city-info">
                    <h3>Shenzhen</h3>
                    <p>Survival Manual for Tech City</p>
                </div>
            </div>
            
            <!-- 广州 -->
            <div class="city-card" onclick="location.href='city.php?city=guangzhou'">
                <img src="https://images.unsplash.com/photo-1649147857403-ea32b99fc0b8?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Guangzhou">
                <div class="city-info">
                    <h3>Guangzhou</h3>
                    <p>Lingnan Culture and Gourmet Paradise</p>
                </div>
            </div>
            
            <!-- Chengdu -->
            <div class="city-card" onclick="location.href='city.php?city=chengdu'">
                <img src="https://images.unsplash.com/photo-1626881465360-68d368877e38?q=80&w=3269&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Chengdu">
                <div class="city-info">
                    <h3>Chengdu</h3>
                    <p>A Guide to Slow Living in Bashir</p>
                </div>
            </div>
            
            <!-- Chongqing -->
            <div class="city-card" onclick="location.href='city.php?city=chongqing'">
                <img src="https://images.unsplash.com/photo-1581252167648-643051a9433e?q=80&w=3270&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Chongqing">
                <div class="city-info">
                    <h3>Chongqing</h3>
                    <p>Magical living guide in mountain city</p>
                </div>
            </div>
            
            <!-- HongKong -->
            <div class="city-card" onclick="location.href='city.php?city=hongkong'">
                <img src="https://images.unsplash.com/photo-1619187269972-267d2b78a423?q=80&w=3174&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="HongKong">
                <div class="city-info">
                    <h3>Hong Kong</h3>
                    <p>The past and the future of port cities</p>
                </div>
            </div>

            <!-- Macau -->
            <div class="city-card" onclick="location.href='city.php?city=macau'">
                <img src="https://images.unsplash.com/photo-1555331446-0ff637678740?q=80&w=2765&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Macau">
                <div class="city-info">
                    <h3>Macau</h3>
                    <p>Lost in Casino Paradise</p >
                </div>
            </div>
        </div>
    </section>
</body>
</html>