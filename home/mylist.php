<?php
session_start();
$favorites = [
    [
        'id' => 1,
        'name' => 'Hong Kong',
        'title' => 'Hong Kong SAR',
        'image' => './assets/images/property-1.jpg',
        'description' => 'Disneyland, Victoria Peak, Ocean Park...'
    ],
    [
        'id' => 3,
        'name' => 'Shanghai',
        'title' => 'Shanghai, China',
        'image' => './assets/images/property-3.jpg',
        'description' => 'The Bund, Oriental Pearl Tower, Yu Garden...'
    ],
    [
        'id' => 4,
        'name' => 'Beijing',
        'title' => 'Beijing, China',
        'image' => './assets/images/property-4.jpg',
        'description' => 'Great Wall, Forbidden City, Tiananmen Square...'
    ]
];
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
                                <span class="material-symbols-rounded">favorite</span>
                                <h3 class="headline-small">您的清單目前為空</h3>
                                <p class="body-large">在城市頁面點選心心圖標，將您喜愛的目的地添加到這裡！</p>
                                <a href="cities.php" class="btn btn-outline">
                                    <span class="label-medium">探索城市</span>
                                    <span class="material-symbols-rounded" aria-hidden="true">arrow_outward</span>
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