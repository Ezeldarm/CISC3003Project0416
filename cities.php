<?php
session_start();
include 'cities_data.php'; // 包含城市数据
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City</title>
    <meta name="title" content="China Travel Starter Pack">
    <meta name="description" content="This is a realestate website devloped by Group 02">
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0..1,0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/script.js" defer></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const favButtons = document.querySelectorAll('.fav-btn');
        
        // 获取用户已收藏的城市
        async function getFavoriteCities() {
            try {
                const response = await fetch('get_favorites.php');
                const data = await response.json();
                if (data.success) {
                    return data.favorites;
                }
                return [];
            } catch (error) {
                console.error('Error:', error);
                return [];
            }
        }

        // 初始化收藏按钮状态
        async function initializeFavoriteButtons() {
            const favorites = await getFavoriteCities();
            favButtons.forEach(button => {
                const cityName = button.getAttribute('data-city');
                if (favorites.includes(cityName)) {
                    button.classList.add('favorited');
                    button.querySelector('.material-symbols-rounded').style.color = '#ff4d4d';
                }
            });
        }

        // 初始化按钮状态
        initializeFavoriteButtons();
        
        favButtons.forEach(button => {
            button.addEventListener('click', async function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const cityName = this.getAttribute('data-city');
                const isFavorited = this.classList.contains('favorited');
                
                try {
                    const formData = new FormData();
                    formData.append('city_name', cityName);
                    formData.append('action', isFavorited ? 'remove' : 'add');
                    
                    const response = await fetch('toggle_favorite.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const data = await response.json();
                    console.log('Response:', data); // 添加调试日志
                    
                    if (data.success) {
                        if (isFavorited) {
                            this.classList.remove('favorited');
                            this.querySelector('.material-symbols-rounded').style.color = '#666';
                        } else {
                            this.classList.add('favorited');
                            this.querySelector('.material-symbols-rounded').style.color = '#ff4d4d';
                        }
                    } else if (data.error === 'not_logged_in') {
                        window.location.href = 'login.php';
                    } else {
                        console.error('Error:', data.error);
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });
    });
    </script>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <main>
            <div>
                <section class="section property">
                    <div class="container">
                        <div class="title-wrapper">
                            <div>
                                <h2 class="section-title headline-small">All cities</h2>
                                <p class="section-text body-large">
                                    Choose a city as your destination and get started with your travel.
                                </p>
                            </div>
                        </div>
                        <div class="property-list">
                            <?php foreach ($citiesData as $city): ?>
                            <div class="card">
                                <div class="card-banner">
                                    <figure class="img-holder" style="--width: 585; --height: 390;">
                                        <a href="specific_cities.php?city=<?php echo urlencode($city['name']); ?>">
                                            <img src="<?php echo htmlspecialchars($city['image']); ?>" width="585" height="390" alt="<?php echo htmlspecialchars($city['title']); ?>" class="img-cover">
                                        </a>
                                    </figure>
                                    <?php if (!empty($city['badge'])): ?>
                                        <span class="badge label-medium"><?php echo htmlspecialchars($city['badge']); ?></span>
                                    <?php endif; ?>
                                    <button type="button" class="icon-btn fav-btn" aria-label="add to favorite" data-city="<?php echo htmlspecialchars($city['name']); ?>">
                                        <span class="material-symbols-rounded" aria-hidden="true">favorite</span>
                                    </button>
                                </div>
                                <div class="card-content">
                                    <span class="title-large"><?php echo htmlspecialchars($city['name']); ?></span>
                                    <h3><a href="specific_cities.php?city=<?php echo urlencode($city['name']); ?>" class="title-small card-title"><?php echo htmlspecialchars($city['title']); ?></a></h3>
                                    <address class="body-medium card-text"><?php echo htmlspecialchars($city['description']); ?></address>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <section class="section feature" aria-labelledby="feature-label">
                    <div class="container">
                        <figure class="feature-banner">
                            <img src="./assets/images/feature-banner-1.jpg" width="1020" height="690" loading="lazy" alt="feature banner" class="img-cover">
                        </figure>
                        <div class="feature-content">
                            <p class="title-small feature-text">Article</p>
                            <h2 class="headline-large" id="feature-label">China Travel 101: Essential Prep Before You Go</h2>
                            <p class="body-large feature-text">
                                Traveling to China is an incredible experience—but a little preparation goes a long way. From payments to apps, here's your must-know checklist to avoid surprises and travel like a savvy explorer.
                            </p>
                            <ul class="feature-list">
                                <li class="feautre-item">
                                    <span class="material-symbols-rounded feature-icon" aria-hidden="true">check_circle</span>
                                    <span class="body-medium">Cash & Payments</span>
                                </li>
                                <li class="feautre-item">
                                    <span class="material-symbols-rounded feature-icon" aria-hidden="true">check_circle</span>
                                    <span class="body-medium"> Must-Have Apps</span>
                                </li>
                                <li class="feautre-item">
                                    <span class="material-symbols-rounded feature-icon" aria-hidden="true">check_circle</span>
                                    <span class="body-medium">Internet & SIM Cards</span>
                                </li>
                                <li class="feautre-item">
                                    <span class="material-symbols-rounded feature-icon" aria-hidden="true">check_circle</span>
                                    <span class="body-medium">Cultural Prep</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
                <section class="section feature feature-2" aria-labelledby="feature-label-2">
                    <div class="container">
                        <figure class="feature-banner">
                            <img src="./assets/images/feature-banner-2.jpg" width="1020" height="690" loading="lazy" alt="feature banner" class="img-cover">
                        </figure>
                        <div class="feature-content">
                            <h2 class="headline-medium" id="feature-label-2">We Are Experts In Historic Home Renovations</h2>
                            <p class="body-large feature-text">
                                Looking to renovate your home to reflect your style and personality? Look no further than our team of experts who specialize in quality home renovations to transform your space into a dream home you'll love. From design to execution.
                            </p>
                            <ul class="feature-list">
                                <li class="feautre-item">
                                    <span class="material-symbols-rounded feature-icon" aria-hidden="true">check_circle</span>
                                    <span class="body-medium">Smart Home</span>
                                </li>
                                <li class="feautre-item">
                                    <span class="material-symbols-rounded feature-icon" aria-hidden="true">check_circle</span>
                                    <span class="body-medium">Beautiful Scene Around</span>
                                </li>
                                <li class="feautre-item">
                                    <span class="material-symbols-rounded feature-icon" aria-hidden="true">check_circle</span>
                                    <span class="body-medium">Exceptional lifestyle</span>
                                </li>
                                <li class="feautre-item">
                                    <span class="material-symbols-rounded feature-icon" aria-hidden="true">check_circle</span>
                                    <span class="body-medium">Complete 24/7 Security</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
                <div class="section video">
                    <div class="container">
                        <div class="video-card">
                            <button class="play-btn" aria-label="play video">
                                <span class="material-symbols-rounded" aria-hidden="true">play_arrow</span>
                            </button>
                        </div>
                    </div>
                </div>
                <section class="section story">
                    <div class="container">
                        <div class="title-wrapper">
                            <div>
                                <p class="section-subtitle title-medium">Our Customers</p>
                                <h2 class="section-title headline-medium">We Help 1000+ Family Find Their True Home</h2>
                                <ul class="avatar-list">
                                    <li class="avatar">
                                        <img src="./assets/images/avatar-1.jpg" width="120" height="80" loading="lazy" alt="John smith" class="img-cover">
                                    </li>
                                    <li class="avatar">
                                        <img src="./assets/images/avatar-2.jpg" width="120" height="80" loading="lazy" alt="Jane smith" class="img-cover">
                                    </li>
                                    <li class="avatar">
                                        <img src="./assets/images/avatar-3.jpg" width="120" height="80" loading="lazy" alt="John smith" class="img-cover">
                                    </li>
                                    <li class="avatar">
                                        <img src="./assets/images/avatar-4.jpg" width="120" height="80" loading="lazy" alt="Jane smith" class="img-cover">
                                        <div class="overlay-content">
                                            <span class="label-medium">99+</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="#" class="btn btn-outline">
                                <span class="label-medium">View All Stories</span>
                                <span class="material-symbols-rounded" aria-hidden="true">arrow_outward</span>
                            </a>
                        </div>
                        <ul class="story-list">
                            <li class="story-card" style="background-image: url('./assets/images/story-1.jpg')">
                                <a href="#" class="overlay-content">
                                    <div>
                                        <h3 class="title-small">Chris Traeger</h3>
                                        <div class="rating-wrapper">
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <data class="title-small rating-text" value="5">5.0</data>
                                        </div>
                                    </div>
                                    <figure class="card-avatar">
                                        <img src="./assets/images/story-avatar-1.jpg" width="56" height="56" loading="lazy" alt="Chris Traeger" class="img-cover">
                                    </figure>
                                </a>
                            </li>
                            <li class="story-card" style="background-image: url('./assets/images/story-2.jpg')">
                                <a href="#" class="overlay-content">
                                    <div>
                                        <h3 class="title-small">Duke Silver</h3>
                                        <div class="rating-wrapper">
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <data class="title-small rating-text" value="5">5.0</data>
                                        </div>
                                    </div>
                                    <figure class="card-avatar">
                                        <img src="./assets/images/story-avatar-2.jpg" width="56" height="56" loading="lazy" alt="Duke Silver" class="img-cover">
                                    </figure>
                                </a>
                            </li>
                            <li class="story-card" style="background-image: url('./assets/images/story-3.jpg')">
                                <a href="#" class="overlay-content">
                                    <div>
                                        <h3 class="title-small">Tsukasa Aoi</h3>
                                        <div class="rating-wrapper">
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <data class="title-small rating-text" value="5">5.0</data>
                                        </div>
                                    </div>
                                    <figure class="card-avatar">
                                        <img src="./assets/images/story-avatar-3.jpg" width="56" height="56" loading="lazy" alt="Tsukasa Aoi" class="img-cover">
                                    </figure>
                                </a>
                            </li>
                            <li class="story-card" style="background-image: url('./assets/images/story-4.jpg')">
                                <a href="#" class="overlay-content">
                                    <div>
                                        <h3 class="title-small">Freida Varnes</h3>
                                        <div class="rating-wrapper">
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <data class="title-small rating-text" value="5">5.0</data>
                                        </div>
                                    </div>
                                    <figure class="card-avatar">
                                        <img src="./assets/images/story-avatar-4.jpg" width="56" height="56" loading="lazy" alt="Freida Varnes" class="img-cover">
                                    </figure>
                                </a>
                            </li>
                            <li class="story-card" style="background-image: url('./assets/images/story-5.jpg')">
                                <a href="#" class="overlay-content">
                                    <div>
                                        <h3 class="title-small">Carl Lorthner</h3>
                                        <div class="rating-wrapper">
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <data class="title-small rating-text" value="5">5.0</data>
                                        </div>
                                    </div>
                                    <figure class="card-avatar">
                                        <img src="./assets/images/story-avatar-5.jpg" width="56" height="56" loading="lazy" alt="Carl Lorthner" class="img-cover">
                                    </figure>
                                </a>
                            </li>
                            <li class="story-card" style="background-image: url('./assets/images/story-6.jpg')">
                                <a href="#" class="overlay-content">
                                    <div>
                                        <h3 class="title-small">Marci Senter</h3>
                                        <div class="rating-wrapper">
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <span class="material-symbols-rounded" aria-hidden="true">star</span>
                                            <data class="title-small rating-text" value="5">5.0</data>
                                        </div>
                                    </div>
                                    <figure class="card-avatar">
                                        <img src="./assets/images/story-avatar-6.jpg" width="56" height="56" loading="lazy" alt="Marci Senter" class="img-cover">
                                    </figure>
                                </a>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>