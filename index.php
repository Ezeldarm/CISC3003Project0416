<?php
session_start();

// 如果用户未登录且尝试访问需要登录的页面，保存当前URL并重定向到登录页面
$protected_pages = ['mylist.php', 'mypost.php', 'profile.php'];
$current_page = basename($_SERVER['PHP_SELF']);

if (in_array($current_page, $protected_pages) && !isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>China Travel Starter Pack</title>
    <meta name="title" content="China Travel Starter Pack">
    <meta name="description" content="This is a realestate website devloped by Group 02">
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0..1,0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <main>
            <div>
                <section class="hero">
                    <div class="container">
                        <div class="hero-content">
                            <h2 class="headline-large hero-title">Travel China Like a Pro.</h2>
                            <p class="body-large hero-text">
                                Your Starter Pack Essentials — from custom tips to community insights.
                            </p>
                            <div class="search-bar">
                                <div class="title-large card-text">Swipe like a game.<br> Get smart travel tips made just for you.</div>   
                                    <button type="submit" class="search-btn" onclick="window.location.href='swipe_cards.html'">
                                        <span class="label-medium">Let's Go!</span>
                                    </button>
                            </div>
                        </div>
                        <img src="./assets/images/hero.jpg" width="1240" height="840" class="bg-pattern" alt="bg">
                    </div>
                </section>
                <section class="section property">
                    <div class="container">
                        <div class="title-wrapper">
                            <div>
                                <h2 class="section-title headline-small">You Journey starts in...</h2>
                                <p class="section-text body-large">
                                    Choose a city as your destination and get started with your travel.
                                </p>
                            </div>
                            <a href="cities.php" class="btn btn-outline">
                                <span class="label-medium">Explore more</span>
                                <span class="material-symbols-rounded" aria-hidden="true">arrow_outward</span>
                            </a>
                        </div>
                        <div class="property-list">
                            <div class="card">
                                <div class="card-banner">
                                    <figure class="img-holder" style="--width: 585; --height: 390;">
                                        <a href="specific_cities.php?city=Hong+Kong">
                                            <img src="./assets/images/property-1.jpg" width="585" height="390" alt="COVA Home Realty" class="img-cover">
                                        </a>
                                    </figure>
                                    <span class="badge label-medium">New</span>
                                    <button type="button" class="icon-btn fav-btn" aria-label="add to favorite" data-city="Hong Kong">
                                        <span class="material-symbols-rounded" aria-hidden="true">favorite</span>
                                    </button>
                                </div>
                                <div class="card-content">
                                    <span class="title-large">Hong Kong</span>
                                    <h3><a href="specific_cities.php?city=Hong+Kong" class="title-small card-title">Hong Kong SAR</a></h3>
                                    <address class="body-medium card-text">Disneyland, Victoria Peak, Ocean Park...</address>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-banner">
                                    <figure class="img-holder" style="--width: 585; --height: 390;">
                                        <a href="specific_cities.php?city=Macao">
                                            <img src="./assets/images/property-2.jpg" width="585" height="390" alt="Exit Realty" class="img-cover">
                                        </a>
                                    </figure>
                                    <button type="button" class="icon-btn fav-btn" aria-label="add to favorite" data-city="Macao">
                                        <span class="material-symbols-rounded" aria-hidden="true">favorite</span>
                                    </button>
                                </div>
                                <div class="card-content">
                                    <span class="title-large">Macao</span>
                                    <h3><a href="specific_cities.php?city=Macao" class="title-small card-title">Macao SAR</a></h3>
                                    <address class="body-medium card-text">Ruins of St. Paul's, Grand Lisboa...</address>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-banner">
                                    <figure class="img-holder" style="--width: 585; --height: 390;">
                                        <a href="specific_cities.php?city=Shanghai">
                                            <img src="./assets/images/property-3.jpg" width="585" height="390" alt="The Real Estate Group" class="img-cover">
                                        </a>
                                    </figure>
                                    <button type="button" class="icon-btn fav-btn" aria-label="add to favorite" data-city="Shanghai">
                                        <span class="material-symbols-rounded" aria-hidden="true">favorite</span>
                                    </button>
                                </div>
                                <div class="card-content">
                                    <span class="title-large">Shanghai</span>
                                    <h3><a href="specific_cities.php?city=Shanghai" class="title-small card-title">Shanghai, China</a></h3>
                                    <address class="body-medium card-text">The Bund, Oriental Pearl Tower, Yu Garden...</address>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-banner">
                                    <figure class="img-holder" style="--width: 585; --height: 390;">
                                        <a href="specific_cities.php?city=Beijing">
                                            <img src="./assets/images/property-4.jpg" width="585" height="390" alt="757 Realty" class="img-cover">
                                        </a>
                                    </figure>
                                    <button type="button" class="icon-btn fav-btn" aria-label="add to favorite" data-city="Beijing">
                                        <span class="material-symbols-rounded" aria-hidden="true">favorite</span>
                                    </button>
                                </div>
                                <div class="card-content">
                                    <span class="title-large">Beijing</span>
                                    <h3><a href="specific_cities.php?city=Beijing" class="title-small card-title">Beijing, China</a></h3>
                                    <address class="body-medium card-text">Great Wall, Forbidden City, Tiananmen Square...</address>
                                </div>
                            </div>
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
                            <h2 class="headline-large" id="feature-label"><a href='article.php'>China Travel 101: Essential Prep Before You Go</a></h2>
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

                <section class="section forum" aria-labelledby="forum-label">
                    <div class="container">
                        <div class="title-wrapper">
                            <div>
                                <p class="section-subtitle title-medium">Community Insights</p>
                                <h2 class="section-title headline-medium" id="forum-label">Travel Stories & Tips from China Explorers</h2>
                                <p class="section-text body-large">
                                    Join our community of travelers sharing their adventures, itineraries, and insider tips for exploring China.
                                </p>
                            </div>
                            <a href="#" class="btn btn-outline">
                                <span class="label-medium">View All Posts</span>
                                <span class="material-symbols-rounded" aria-hidden="true">arrow_outward</span>
                            </a>
                        </div>
                        <ul class="forum-list">
                            <li class="forum-post">
                                <div class="post-header">
                                    <figure class="post-avatar">
                                        <img src="./assets/images/avatar-1.jpg" width="56" height="56" loading="lazy" alt="Emma_TravelBug" class="img-cover">
                                    </figure>
                                    <div class="post-meta">
                                        <h3 class="title-small">Emma_TravelBug</h3>
                                        <time class="body-medium" datetime="2025-04-15">April 15, 2025</time>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h4 class="title-medium post-title">
                                        <a href="#">My Whirlwind Week in Beijing & Shanghai</a>
                                    </h4>
                                    <p class="body-large post-text">
                                        Just got back from an incredible 7-day trip to China! Started in Beijing with the Great Wall at Mutianyu—absolutely breathtaking, though the climb was no joke. Then explored the Forbidden City and indulged in Peking duck at Da Dong. Took the high-speed train to Shanghai, where The Bund at night is pure magic... 
                                    </p>
                                </div>
                            </li>
                            <li class="forum-post">
                                <div class="post-header">
                                    <figure class="post-avatar">
                                        <img src="./assets/images/avatar-2.jpg" width="56" height="56" loading="lazy" alt="Luca_Wanderer" class="img-cover">
                                    </figure>
                                    <div class="post-meta">
                                        <h3 class="title-small">Luca_Wanderer</h3>
                                        <time class="body-medium" datetime="2025-04-10">April 10, 2025</time>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h4 class="title-medium post-title">
                                        <a href="#">Navigating Hong Kong Like a Local</a>
                                    </h4>
                                    <p class="body-large post-text">
                                        Hong Kong was a blast! Spent my first day hiking Dragon's Back—stunning views and not too crowded. Then hit the street markets in Mong Kok for some bargain souvenirs and the best dim sum at Tim Ho Wan. Pro tip: get a local SIM card at 7-Eleven for cheap data... 
                                    </p>
                                </div>
                            </li>
                            <li class="forum-post">
                                <div class="post-header">
                                    <figure class="post-avatar">
                                        <img src="./assets/images/avatar-3.jpg" width="56" height="56" loading="lazy" alt="Sophie_Adventures" class="img-cover">
                                    </figure>
                                    <div class="post-meta">
                                        <h3 class="title-small">Sophie_Adventures</h3>
                                        <time class="body-medium" datetime="2025-04-05">April 5, 2025</time>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h4 class="title-medium post-title">
                                        <a href="#">Chasing History in Xi'an</a>
                                    </h4>
                                    <p class="body-large post-text">
                                        Xi'an stole my heart! The Terracotta Warriors were mind-blowing—definitely worth the hype. Cycled around the ancient city wall for a unique perspective, and the Muslim Quarter's food stalls were a highlight (lamb skewers, anyone?). Highly recommend downloading DiDi for easy rides... 
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
                <!--<section class="section story">
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
                </section>-->
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>

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
</body>
</html>