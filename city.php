<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>城市详情 - CityLife指南</title>
    <style>
        /* 全局样式 (从 index.html 借鉴) */
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
        
        /* 头部样式 (从 index.html 借鉴) */
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
            cursor: pointer; /* Add cursor pointer for home link */
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

        /* 页面主要内容区域 */
        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .city-hero {
            height: 350px;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: flex-end; /* Align text to bottom */
            justify-content: center; /* Center text horizontally */
            color: white;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .city-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.1)); /* Gradient overlay */
        }

        .city-hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 2rem;
        }

        .city-hero h1 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
        }

        .city-hero p {
            font-size: 1.2rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        .city-section {
            background: white;
            padding: 2rem;
            margin-bottom: 2rem;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .city-section h2 {
            color: #444;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #eee;
            padding-bottom: 0.5rem;
        }

        /* 景点网格 */
        .attractions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .attraction-card {
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            transition: box-shadow 0.3s;
        }

        .attraction-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .attraction-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .attraction-info {
            padding: 1rem;
        }

        .attraction-info h3 {
            margin-bottom: 0.5rem;
            color: #333;
        }

        .attraction-info p {
            font-size: 0.9rem;
            color: #666;
        }

        /* 生活信息 */
        .living-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-card {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 5px;
            border: 1px solid #eee;
        }

        .info-card h3 {
            color: #555;
            margin-bottom: 1rem;
        }

        /* 页脚样式 */
        footer {
            background: #333;
            color: #ccc;
            padding: 2rem 0;
            margin-top: 3rem;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .footer-section h3 {
            color: white;
            margin-bottom: 0.5rem;
        }

        .footer-section a {
            color: #ccc;
            text-decoration: none;
            display: block;
            margin-bottom: 0.3rem;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #555;
            padding-top: 1rem;
            font-size: 0.9rem;
        }

        /* 响应式设计 */
        @media (max-width: 768px) {
            header {
                padding: 1rem;
            }
            .city-hero h1 {
                font-size: 2.5rem;
            }
            .city-hero p {
                font-size: 1rem;
            }
            main {
                padding: 0 1rem;
            }
            .city-section {
                padding: 1.5rem;
            }
            .attractions-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            }
        }

        @media (max-width: 480px) {
            header {
                flex-direction: column;
            }
            .logo {
                margin-bottom: 1rem;
            }
            .auth-buttons {
                margin-top: 0.5rem;
            }
            .city-hero {
                height: 250px;
            }
            .city-hero h1 {
                font-size: 2rem;
            }
            .city-hero p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <header>
         <div class="logo" onclick="location.href='index.php'"><a href="index.php">CityLife指南</a></div>
         <div class="auth-buttons">
             <?php 
             
             if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                 <span style="margin-right: 1rem; color: white;">欢迎, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                 <button class="btn logout-btn" onclick="location.href='logout.php'">退出</button>
             <?php else: ?>
                 <button class="btn login-btn" onclick="location.href='login.php'">登录</button>
                 <button class="btn register-btn" onclick="location.href='register.html'">注册</button>
             <?php endif; ?>
         </div>
    </header>

    <main>
        <?php 
            // Include database config to potentially fetch city data later
            // require_once 'db_config.php'; 

            // Get city name from URL parameter, default to '未知城市'
            $city_name_raw = isset($_GET['city']) ? $_GET['city'] : '未知城市';
            $city_name = htmlspecialchars($city_name_raw);

            // --- Placeholder Data --- 
            // In a real application, fetch this data from the database based on $city_name_raw
            $city_data = [
                'beijing' => [
                    'title' => '探索 北京',
                    'description' => '中国的首都，历史与现代的交汇点。',
                    'hero_image' => 'https://images.unsplash.com/photo-1559941150-f5f4a894999a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDF8fGJlaWppbmclMjBjaXR5fGVufDB8fHx8MTYxODQyMzIwMQ&ixlib=rb-1.2.1&q=80&w=1080',
                    'overview' => '北京，作为中国的政治、文化中心，拥有悠久的历史和丰富的文化遗产。从宏伟的故宫到现代化的鸟巢，这座城市展现了古老与现代的完美融合。',
                    'attractions' => [
                        ['name' => '故宫博物院', 'image' => 'https://via.placeholder.com/300x180.png?text=Forbidden+City', 'desc' => '明清两代的皇家宫殿，世界上最大的宫殿建筑群。'],
                        ['name' => '天安门广场', 'image' => 'https://via.placeholder.com/300x180.png?text=Tiananmen+Square', 'desc' => '世界上最大的城市广场之一，中国的象征。'],
                        ['name' => '颐和园', 'image' => 'https://via.placeholder.com/300x180.png?text=Summer+Palace', 'desc' => '清代的皇家园林，风景如画。']
                    ],
                    'cost' => '相对较高，尤其是在市中心区域。',
                    'transport' => '拥有发达的地铁网络、公交系统和出租车服务。'
                ],
                'shanghai' => [
                    'title' => '探索 上海',
                    'description' => '中国的经济中心，充满活力的国际大都市。',
                    'hero_image' => 'https://images.unsplash.com/photo-1587899769069-8040905f3a4b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDF8fHNoYW5naGFpJTIwY2l0eXxlbnwwfHx8fDE2MTg0MjMyMzA&ixlib=rb-1.2.1&q=80&w=1080',
                    'overview' => '上海以其现代化的天际线、繁华的商业街和独特的历史建筑而闻名。外滩的夜景、南京路的购物体验以及法租界的风情都令人难忘。',
                    'attractions' => [
                        ['name' => '外滩', 'image' => 'https://via.placeholder.com/300x180.png?text=The+Bund', 'desc' => '欣赏浦东天际线和历史建筑的最佳地点。'],
                        ['name' => '南京路', 'image' => 'https://via.placeholder.com/300x180.png?text=Nanjing+Road', 'desc' => '中国最著名的商业街之一。'],
                        ['name' => '豫园', 'image' => 'https://via.placeholder.com/300x180.png?text=Yu+Garden', 'desc' => '古典江南园林的代表。']
                    ],
                    'cost' => '中国生活成本最高的城市之一。',
                    'transport' => '地铁系统极其发达，覆盖广泛，还有公交、轮渡和磁悬浮列车。'
                ],
                // Add more cities here...
                'default' => [
                    'title' => '探索 ' . ucfirst($city_name),
                    'description' => '发现' . ucfirst($city_name) . '的独特魅力',
                    'hero_image' => 'https://images.unsplash.com/photo-1508804185872-d7badad00f7d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80', 
                    'overview' => '关于 ' . ucfirst($city_name) . ' 的详细介绍将在这里显示...', 
                    'attractions' => [
                        ['name' => '景点名称 1', 'image' => 'https://via.placeholder.com/300x180.png?text=Attraction+1', 'desc' => '景点简介...'],
                        ['name' => '景点名称 2', 'image' => 'https://via.placeholder.com/300x180.png?text=Attraction+2', 'desc' => '景点简介...']
                    ],
                    'cost' => '详细的生活成本信息...', 
                    'transport' => '公共交通、出租车等信息...'
                ]
            ];

            // Select data for the current city, or default if not found
            $current_city_data = isset($city_data[strtolower($city_name_raw)]) ? $city_data[strtolower($city_name_raw)] : $city_data['default'];

            $city_title = $current_city_data['title'];
            $city_description = $current_city_data['description'];
            $hero_image = $current_city_data['hero_image'];
            $overview_content = $current_city_data['overview'];
            $attractions = $current_city_data['attractions'];
            $cost_details = $current_city_data['cost'];
            $transport_details = $current_city_data['transport'];
        ?>
        <section class="city-hero" style="background-image: url('<?php echo $hero_image; ?>');">
            <div class="city-hero-content">
                <h1><?php echo $city_title; ?></h1>
                <p><?php echo $city_description; ?></p>
            </div>
        </section>

        <section id="overview" class="city-section">
            <h2>城市概览</h2>
            <div class="overview-content">
                <p><?php echo $overview_content; ?></p>
            </div>
        </section>

        <section id="attractions" class="city-section">
            <h2>热门景点</h2>
            <div class="attractions-grid">
                <?php foreach ($attractions as $attraction): ?>
                <div class="attraction-card">
                    <img src="<?php echo htmlspecialchars($attraction['image']); ?>" alt="<?php echo htmlspecialchars($attraction['name']); ?>">
                    <div class="attraction-info">
                        <h3><?php echo htmlspecialchars($attraction['name']); ?></h3>
                        <p><?php echo htmlspecialchars($attraction['desc']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if (empty($attractions)): ?>
                    <p>暂无推荐景点信息。</p>
                <?php endif; ?>
            </div>
        </section>

        <section id="living" class="city-section">
            <h2>生活信息</h2>
            <div class="living-info">
                <div class="info-card">
                    <h3>生活成本</h3>
                    <p><?php echo $cost_details; ?></p>
                </div>
                <div class="info-card">
                    <h3>交通指南</h3>
                    <p><?php echo $transport_details; ?></p>
                </div>
                <div class="info-card">
                    <h3>紧急联系</h3>
                    <p>警察: 110, 消防: 119, 急救: 120</p>
                </div>
            </div>
        </section>

        <!-- Feedback/Comments sections can be added later if needed -->

    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>关于我们</h3>
                <p>您的中国城市生活综合指南</p>
            </div>
            <div class="footer-section">
                <h3>快速链接</h3>
                <a href="index.php">首页</a>
                <a href="#">城市</a>
                <a href="#">旅行贴士</a>
            </div>
             <div class="footer-section">
                <h3>联系我们</h3>
                <a href="mailto:info@citylifeguide.com">info@citylifeguide.com</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 CityLife指南. 保留所有权利.</p>
        </div>
    </footer>

    <!-- Removed React/Babel script includes -->
</body>
</html>