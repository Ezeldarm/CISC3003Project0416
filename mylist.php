<?php
session_start();
require_once 'db_config.php';

// 检查用户是否已登录
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php');
    exit;
}

// 从数据库获取用户喜欢的城市
$favorites = [];
try {
    // 使用db_config.php中定义的常量
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
    $conn->set_charset("utf8mb4");

    if ($conn->connect_error) {
        throw new Exception("连接失败: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT city_name FROM favorite_cities WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // 城市信息映射
    $city_info = [
        'Hong Kong' => [
            'title' => 'Hong Kong SAR',
            'image' => './assets/images/property-1.jpg',
            'description' => 'Disneyland, Victoria Peak, Ocean Park...'
        ],
        'Macao' => [
            'title' => 'Macao SAR',
            'image' => './assets/images/property-2.jpg',
            'description' => 'Ruins of St. Paul\'s, Grand Lisboa...'
        ],
        'Shanghai' => [
            'title' => 'Shanghai, China',
            'image' => './assets/images/property-3.jpg',
            'description' => 'The Bund, Oriental Pearl Tower, Yu Garden...'
        ],
        'Beijing' => [
            'title' => 'Beijing, China',
            'image' => './assets/images/property-4.jpg',
            'description' => 'Great Wall, Forbidden City, Tiananmen Square...'
        ],
        'Lijiang' => [
            'title' => 'Yunnan, China',
            'image' => './assets/images/property-5.jpg',
            'description' => 'Jade Dragon Snow Mountain, Old Town of Lijiang, Lugu Lake...'
        ],
        'Chengdu' => [
            'title' => 'Sichuan, China',
            'image' => './assets/images/property-6.jpg',
            'description' => 'Hot Pot, Pandas, Leshan Buddha...'
        ],
        'Guangzhou' => [
            'title' => 'Guangdong, China',
            'image' => './assets/images/property-7.jpg',
            'description' => 'Yum Cha, Canton Tower, Chimelong Safari Park, Shamian Island...'
        ],
        'Harbin' => [
            'title' => 'Heilongjiang, China',
            'image' => './assets/images/property-8.jpg',
            'description' => 'Harbin Ice and Snow World, Zhongyang Pedestrain Street...'
        ]
    ];

    while ($row = $result->fetch_assoc()) {
        $city_name = $row['city_name'];
        if (isset($city_info[$city_name])) {
            $favorites[] = array_merge(
                ['name' => $city_name],
                $city_info[$city_name]
            );
        }
    }

} catch (Exception $e) {
    error_log($e->getMessage());
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($conn)) {
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyList</title>
    <meta name="title" content="China Travel Starter Pack">
    <meta name="description" content="This is a realestate website devloped by Group 02">
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/script.js" defer></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 获取所有喜欢按钮
        const favButtons = document.querySelectorAll('.fav-btn');
        
        favButtons.forEach(button => {
            button.addEventListener('click', async function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const card = this.closest('.favorite-card');
                const cityName = card.querySelector('.title-large').textContent;
                
                try {
                    const formData = new FormData();
                    formData.append('city_name', cityName);
                    formData.append('action', 'remove');
                    
                    const response = await fetch('toggle_favorite.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const data = await response.json();
                    console.log('Response:', data); // 添加调试日志
                    
                    if (data.success) {
                        // 移除卡片
                        card.remove();
                        
                        // 如果没有更多卡片，显示空消息
                        const favoriteList = document.querySelector('.favorite-list');
                        if (favoriteList && favoriteList.children.length === 0) {
                            location.reload(); // 重新加载页面以显示空消息
                        }
                    } else {
                        console.error('Error:', data.error);
                        if (data.error) {
                            alert(data.error);
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('操作失败，请稍后重试');
                }
            });
        });
    });
    </script>
    <style>
        /* 收藏清單樣式 */
        
        .favorite-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
            padding: 16px;
            animation: slideIn 0.5s ease-out;
        }

        .favorite-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .favorite-card:hover {
            transform: translateY(-4px); /* 懸停上移，與 cities.php 一致 */
        }

        .favorite-card .card-banner {
            position: relative;
        }

        .favorite-card .img-holder {
            aspect-ratio: var(--width) / var(--height);
            overflow: hidden;
        }

        .favorite-card .img-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .favorite-card .card-content {
            padding: 16px;
        }

        .favorite-card .title-large {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .favorite-card .title-small {
            font-size: 1.25rem;
            font-weight: 500;
            color: #e91e63; /* 與網站高亮色一致 */
            text-decoration: none;
        }

        .favorite-card .card-text {
            font-size: 1rem;
            color: #666;
            margin-top: 8px;
        }

        .empty-message {
            text-align: center;
            padding: 48px;
            color: #666;
        }

        .empty-message .material-symbols-rounded {
            font-size: 48px;
            color: #e91e63;
            margin-bottom: 16px;
        }

        .empty-message .headline-small {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .empty-message .body-large {
            font-size: 1.125rem;
            margin-bottom: 24px;
        }

        .btn.btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border: 1px solid #e91e63;
            border-radius: 24px;
            color: #e91e63;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .btn.btn-outline:hover {
            background: #e91e63;
            color: white;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* 響應式調整 */
        @media screen and (max-width: 600px) {
            .favorite-list {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .favorite-card .title-large {
                font-size: 1.25rem;
            }

            .favorite-card .title-small {
                font-size: 1rem;
            }

            .favorite-card .card-text {
                font-size: 0.875rem;
            }

            .empty-message {
                padding: 24px;
            }

            .empty-message .material-symbols-rounded {
                font-size: 36px;
            }

            .empty-message .headline-small {
                font-size: 1.5rem;
            }
        }

        .main-content {
            padding-top: 100px; /* 根據 header 高度調整 */
        }

        .title-wrapper{
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <main>
            <div>
                <section class="section favorite">
                    <div class="container">
                        <div class="title-wrapper">
                            <div>
                                <h2 class="section-title headline-small">My favorite city</h2>
                                <p class="section-text body-large">
                                Here are your favorite travel destinations to plan your next adventure!
                                </p>
                            </div>
                        </div>
                        <?php if (empty($favorites)) { ?>
                            <div class="empty-message">
                                
                                <h3 class="headline-small">Your list is currently empty</h3>
                                <p class="body-large">Click the heart icon on city pages to add your favorite destinations here!</p>
                                <a href="cities.php" class="btn btn-outline">
                                    <span class="label-medium">Explore Cities</span>
                                    
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="favorite-list">
                                <?php foreach ($favorites as $city) { ?>
                                    <div class="favorite-card">
                                        <div class="card-banner">
                                            <figure class="img-holder" style="--width: 585; --height: 390;">
                                                <img src="<?php echo $city['image']; ?>" width="585" height="390" alt="<?php echo htmlspecialchars($city['title']); ?>" class="img-cover">
                                            </figure>
                                            <button type="button" class="icon-btn fav-btn favorited" aria-label="remove from favorite" data-city="<?php echo $city['name']; ?>">
                                                <span class="material-symbols-rounded" style="color: #ff4d4d;" aria-hidden="true">favorite</span>
                                            </button>
                                        </div>
                                        <div class="card-content">
                                            <span class="title-large"><?php echo $city['name']; ?></span>
                                            <h3><a href="#" class="title-small card-title"><?php echo $city['title']; ?></a></h3>
                                            <address class="body-medium card-text"><?php echo $city['description']; ?></address>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </section>
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>