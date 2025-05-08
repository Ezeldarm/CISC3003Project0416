<?php
  // session_start();
  $city = isset($_GET['city']) ? $_GET['city'] : '未知城市';
  
  // 从JSON文件读取城市数据
  $cityData = json_decode(file_get_contents('./data/city.json'), true);
  $cityData = isset($cityData[$city]) ? $cityData[$city] : ['title' => '未知城市'];
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
</head>
<style>
.rating-form {
    background: #c3cfe2;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    margin: 6.5rem 0 5.5rem 0;
}

.rating-form h3 {
    color: #2c3e50;
    margin-bottom: 5rem;
    text-align: center;
}

.form-group {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 5rem;
    padding: 1rem;
    background-color: rgba(255,255,255,0.8);
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-group:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.star-rating {
    display: flex;
    gap: 5px;
}

.star-rating span {
    cursor: pointer;
    font-size: 2rem;
    color: #ccc;
    transition: all 0.2s ease;
}

.star-rating span:hover,
.star-rating span.active {
    color: #FFD700;
    transform: scale(1.2);
}

.btn.submit-rating {
    display: block;
    width: 50%;
    margin: 0 auto;
    padding: 1rem;
    background-color: var(--neutral-100);
    color: var(--neutral-10);
    border-radius: var(--radius-small);
    box-shadow: var(--shadow-3);
    transition: var(--transition-duration-quick) var(--transition-easing-quick);
}

.btn.submit-rating:where(:hover, :focus-visible) { background-color: var(--neutral-90); }
</style>
<body>
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <main>
            <div>
                <section class="hero">
                    <div class="container">
                        <div class="hero-content" >
                            <h2 class="headline-large hero-title"><?php echo $cityData['title']; ?></h2>
                            <p class="body-large hero-text">
                            <?php echo $cityData['description']; ?>
                            </p>
                            <form action="./" method="get" class="search-bar" style="display: none">
                                <div class="title-large card-text">Swipe like a game.<br> Get smart travel tips made just for you.</div>   
                                <button type="submit" class="search-btn">
                                    <span class="label-medium">Let's Go!</span>
                                </button>
                            </form>
                        </div>
                        <img src="<?php echo isset($cityData['hero_image']) ? $cityData['hero_image'] : ''; ?>" width="1240" height="840" class="bg-pattern" alt="bg">
                    </div>
                </section>
                <section class="section property">
                    <div class="container" style="display: none">
                        <div class="title-wrapper">
                            <div>
                                <h2 class="section-title headline-small">This is a city that...</h2>
                                <p><?php echo isset($cityData['overview']) ? $cityData['overview'] : '暂无城市概述'; ?></p>
                            </div>
                            <a href="https://www.discoverhongkong.com/eng/index.html" class="btn btn-outline">
                                <span class="label-medium">More Inf.</span>
                                <span class="material-symbols-rounded" aria-hidden="true">arrow_outward</span>
                            </a>
                        </div>
                        <div class="property-list">
                            <div class="card">
                                <div class="card-banner">
                                    <figure class="img-holder" style="--width: 585; --height: 390;">
                                        <img src="./assets/images/property-1.jpg" width="585" height="390" alt="COVA Home Realty" class="img-cover">
                                    </figure>
                                    <span class="badge label-medium">New</span>
                                    <button class="icon-btn fav-btn" aria-label="add to favorite" data-toggle-btn>
                                        <span class="material-symbols-rounded" aria-hidden="true">favorite</span>
                                    </button>
                                </div>
                                <div class="card-content">
                                    <span class="title-large">Hong Kong</span>
                                    <h3><a href="#" class="title-small card-title">Hong Kong SAR</a></h3>
                                    <address class="body-medium card-text">Disneyland, Victoria Peak, Ocean Park...</address>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-banner">
                                    <figure class="img-holder" style="--width: 585; --height: 390;">
                                        <img src="./assets/images/property-2.jpg" width="585" height="390" alt="Exit Realty" class="img-cover">
                                    </figure>
                                    <button class="icon-btn fav-btn" aria-label="add to favorite" data-toggle-btn>
                                        <span class="material-symbols-rounded" aria-hidden="true">favorite</span>
                                    </button>
                                </div>
                                <div class="card-content">
                                    <span class="title-large">Macao</span>
                                    <h3><a href="#" class="title-small card-title">Macao SAR</a></h3>
                                    <address class="body-medium card-text">Ruins of St. Paul's, Grand Lisboa...</address>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-banner">
                                    <figure class="img-holder" style="--width: 585; --height: 390;">
                                        <img src="./assets/images/property-3.jpg" width="585" height="390" alt="The Real Estate Group" class="img-cover">
                                    </figure>
                                    <button class="icon-btn fav-btn" aria-label="add to favorite" data-toggle-btn>
                                        <span class="material-symbols-rounded" aria-hidden="true">favorite</span>
                                    </button>
                                </div>
                                <div class="card-content">
                                    <span class="title-large">Shanghai</span>
                                    <h3><a href="#" class="title-small card-title">Shanghai, China</a></h3>
                                    <address class="body-medium card-text">The Bund, Oriental Pearl Tower, Yu Garden...</address>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-banner">
                                    <figure class="img-holder" style="--width: 585; --height: 390;">
                                        <img src="./assets/images/property-4.jpg" width="585" height="390" alt="757 Realty" class="img-cover">
                                    </figure>
                                    <button class="icon-btn fav-btn" aria-label="add to favorite" data-toggle-btn>
                                        <span class="material-symbols-rounded" aria-hidden="true">favorite</span>
                                    </button>
                                </div>
                                <div class="card-content">
                                    <span class="title-large">Beijing</span>
                                    <h3><a href="#" class="title-small card-title">Beijing, China</a></h3>
                                    <address class="body-medium card-text">Great Wall, Forbidden City, Tiananmen Square...</address>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title-wrapper" style="padding: 0 20px">
                        <div>
                            <h2 class="section-title headline-small">It's a city that...</h2>
                            <p><?php echo isset($cityData['overview']) ? $cityData['overview'] : '暂无城市概述'; ?></p>
                        </div>
                        <a href="https://www.discoverhongkong.com/eng/index.html" class="btn btn-outline">
                            <span class="label-medium">More Inf.</span>
                            <span class="material-symbols-rounded" aria-hidden="true">arrow_outward</span>
                        </a>
                    </div>
                    <div class="container" style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <?php if(isset($cityData['attractions'])): ?>
                        <?php 
                            $showAll = isset($_GET['show_all']) && $_GET['show_all'] === 'true';
                            $attractionCount = count($cityData['attractions']);
                            $displayAttractions = $showAll ? $cityData['attractions'] : array_slice($cityData['attractions'], 0, 4);
                        ?>
                        <?php foreach($displayAttractions as $attraction): ?>
                            <div class="attraction-item" onclick="window.open('<?php echo $attraction['website']; ?>', '_blank')" style="display: flex; flex: 0 0 calc(50% - 20px); margin-bottom: 20px; border: 1px solid #ddd; padding: 15px; border-radius: 8px; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.boxShadow='0 0 10px rgba(0,0,0,0.2)'; this.style.transform='translateY(-5px)';" onmouseout="this.style.boxShadow='none'; this.style.transform='none';">
                            <div class="attraction-image" style="flex: 0 0 200px; margin-right: 20px;">
                                <img src="<?php echo $attraction['image']; ?>" alt="<?php echo $attraction['name']; ?>" style="width: 100%; height: 150px; object-fit: cover; border-radius: 4px;">
                            </div>
                            <div class="attraction-info" style="flex: 1; display: grid; grid-template-columns: 1fr; grid-template-rows: auto 1fr; gap: 10px;">
                                <span class="attraction-name" style="font-size: 18px; font-weight: bold; align-self: start;"><?php echo $attraction['name']; ?></span>
                                <p class="attraction-desc" style="color: #666; align-self: end;"><?php echo $attraction['desc']; ?></p>
                            </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if($attractionCount > 4): ?>
                            <div class="toggle-attractions" style="width: 100%; text-align: center; margin: 20px 0; clear: both;">
                            <button onclick="toggleAttractions()" id="toggleBtn" style="padding: 10px 20px; color: #4CAF50; border: none; border-radius: 4px; cursor: pointer; background: none; margin: 0 auto; display: block;">
                                <?php echo $showAll ? '<---- close ---->' : '<---- open (' . ($attractionCount - 4) . ' more) ---->' ?>
                            </button>
                            <script>
                                function toggleAttractions() {
                                const attractions = document.querySelectorAll('.attraction-item');
                                const toggleBtn = document.getElementById('toggleBtn');
                                const showAll = !toggleBtn.textContent.includes('close');
                                
                                // Update URL parameter to maintain state
                                const url = new URL(window.location.href);
                                url.searchParams.set('show_all', showAll);
                                window.history.pushState({}, '', url);
                                
                                // Scroll to current position before reload
                                const scrollPosition = window.scrollY;
                                window.location.reload();
                                window.scrollTo(0, scrollPosition);
                                }
                            </script>
                            </div>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </section>
                <section class="section feature" aria-labelledby="feature-label">
                    <div class="container">
                        <div class="rating-form">
                            <h3 class="title-medium">Rating for city</h3>
                            <form method="post" action="">
                            <div class="form-group">
                                    <label>food</label>
                                    <div class="star-rating">
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'attractions')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'attractions')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'attractions')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'attractions')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'attractions')">star</span>
                                        <input type="hidden" name="attractions_rating" value="0">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>clothing</label>
                                    <div class="star-rating">
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'attractions')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'attractions')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'attractions')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'attractions')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'attractions')">star</span>
                                        <input type="hidden" name="attractions_rating" value="0">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>accommodation</label>
                                    <div class="star-rating">
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'food')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'food')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'food')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'food')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'food')">star</span>
                                        <input type="hidden" name="food_rating" value="0">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>transport</label>
                                    <div class="star-rating">
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'transport')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'transport')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'transport')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'transport')">star</span>
                                        <span class="material-symbols-rounded" onclick="setRating(this, 'transport')">star</span>
                                        <input type="hidden" name="transport_rating" value="0">
                                    </div>
                                </div>
                                <button type="submit" class="btn submit-rating">Submit</button>
                            </form>
                            <script>
                                function setRating(element, category) {
                                    const stars = element.parentElement.querySelectorAll('span');
                                    const hiddenInput = element.parentElement.querySelector('input[type="hidden"]');
                                    const clickedIndex = Array.from(stars).indexOf(element);
                                    
                                    stars.forEach((star, index) => {
                                        star.style.color = index <= clickedIndex ? '#FFD700' : '#ccc';
                                    });
                                    
                                    hiddenInput.value = clickedIndex + 1;
                                }
                            </script>
                        </div>
                        <div class="feature-content">
                            <?php if(isset($cityData['ratings'])): ?>
                                <div class="rating-section" style="margin-top: 20px; padding: 20px; background: #f8f8f8; border-radius: 8px;">
                                    <h3 class="title-medium" style="margin-bottom: 15px;">city rating</h3>
                                    <?php if(isset($cityData['ratings'])): ?>
                                        <?php foreach($cityData['ratings'] as $category => $rating): ?>
                                            <div class="rating-item" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #ddd;">
                                                <div class="rating-name" style="font-weight: bold; margin-bottom: 5px;"><?php echo $category; ?></div>
                                                <div class="rating-stars" style="display: flex; align-items: center; margin-bottom: 5px;">
                                                    <div style="position: relative; display: inline-flex;">
                                                        <?php 
                                                        $fullStars = floor($rating['score']);
                                                        $partialStar = $rating['score'] - $fullStars;
                                                        for($i=0; $i<5; $i++): ?>
                                                            <span class="material-symbols-rounded" style="color: #ccc;">star</span>
                                                        <?php endfor; ?>
                                                        <div style="position: absolute; top: 0; left: 0; width: <?php echo ($fullStars * 20); ?>%; height: 100%; overflow: hidden; display: flex; flex-direction: row;">
                                                            <?php for($i = 0; $i < $fullStars; $i++): ?>
                                                                <span class="material-symbols-rounded" style="color: #FFD700;">star</span>
                                                            <?php endfor; ?>
                                                        </div>
                                                        <?php if($partialStar > 0): ?>
                                                        <div style="position: absolute; top: 0; left: <?php echo ($fullStars * 20); ?>%; width: <?php echo ($partialStar * 20); ?>%; height: 100%; overflow: hidden;">
                                                            <span class="material-symbols-rounded" style="color: #FFD700;">star</span>
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <span style="margin-left: 5px;"><?php echo $rating['score']; ?>/5</span>
                                                </div>
                                                <div class="rating-desc" style="color: #666;"><?php echo $rating['description']; ?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <section class="section story">
                    <div class="container">
                        <div class="title-wrapper">
                            <div>
                                <h2 class="section-title headline-medium">Last Post</h2>
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