<?php
session_start();

// 初始化收藏清單
if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = [];
}

// 處理移除收藏的請求
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_favorite'])) {
    $city_id = $_POST['city_id'];
    foreach ($_SESSION['favorites'] as $index => $city) {
        if ($city['id'] == $city_id) {
            unset($_SESSION['favorites'][$index]);
            break;
        }
    }
    // 重新索引陣列
    $_SESSION['favorites'] = array_values($_SESSION['favorites']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的清單</title>
    <meta name="title" content="China Travel Starter Pack">
    <meta name="description" content="This is a realestate website devloped by Group 02">
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0..1,0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/script.js" defer></script>
    <style>
        .favorite-list {
            display: grid;
            gap: 24px;
            padding: 16px;
            animation: slideIn 0.5s ease-out;
        }
        .favorite-card {
            position: relative;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        .favorite-card.removing {
            opacity: 0;
            transform: translateY(20px);
        }
        .favorite-card:hover {
            transform: translateY(-4px);
        }
        .favorite-card .card-banner {
            position: relative;
        }
        .favorite-card .remove-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #ff4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .favorite-card .remove-btn:hover {
            background: #cc0000;
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
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    <script>
        function removeFavorite(form) {
            const card = form.closest('.favorite-card');
            card.classList.add('removing');
            setTimeout(() => form.submit(), 300);
        }
    </script>
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
                                <h2 class="section-title headline-small">我的喜愛城市</h2>
                                <p class="section-text body-large">
                                    這裡是您收藏的旅遊目的地，隨時規劃您的下一次冒險！
                                </p>
                            </div>
                        </div>
                        <?php if (empty($_SESSION['favorites'])) { ?>
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
                                <?php foreach ($_SESSION['favorites'] as $city) { ?>
                                    <div class="favorite-card">
                                        <div class="card-banner">
                                            <figure class="img-holder" style="--width: 585; --height: 390;">
                                                <img src="<?php echo $city['image']; ?>" width="585" height="390" alt="<?php echo htmlspecialchars($city['title']); ?>" class="img-cover">
                                            </figure>
                                            <form method="POST" style="display: inline;">
                                                <input type="hidden" name="city_id" value="<?php echo $city['id']; ?>">
                                                <button type="button" class="remove-btn" aria-label="移除收藏" onclick="removeFavorite(this.form)">
                                                    <span class="material-symbols-rounded" aria-hidden="true">close</span>
                                                </button>
                                                <input type="hidden" name="remove_favorite" value="1">
                                            </form>
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