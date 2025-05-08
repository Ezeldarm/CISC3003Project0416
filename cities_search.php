<?php
session_start();
include 'cities_data.php'; // 包含城市数据

$searchTerm = isset($_GET['query']) ? trim($_GET['query']) : '';
$foundCities = [];

if (!empty($searchTerm)) {
    foreach ($citiesData as $city) {
        // 部分匹配搜索（不区分大小写）
        if (stripos($city['name'], $searchTerm) !== false ||
            stripos($city['title'], $searchTerm) !== false ||
            stripos($city['description'], $searchTerm) !== false) {
            $foundCities[] = $city;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - <?php echo htmlspecialchars($searchTerm); ?></title>
    <meta name="title" content="China Travel Starter Pack">
    <meta name="description" content="Search results for cities in China.">
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0..1,0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/script.js" defer></script>
    <script>
    // Copying the favorite button JavaScript logic from cities.php
    document.addEventListener('DOMContentLoaded', function() {
        const favButtons = document.querySelectorAll('.fav-btn');
        
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
                                <h2 class="section-title headline-small">Search Results for "<?php echo htmlspecialchars($searchTerm); ?>"</h2>
                                <?php if (!empty($foundCities)): ?>
                                <p class="section-text body-large">
                                    <?php echo count($foundCities); ?> result(s) found
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="property-list">
                            <?php if (!empty($foundCities)): ?>
                                <?php foreach ($foundCities as $city): ?>
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
                            <?php elseif (!empty($searchTerm)): ?>
                                <p class="section-text body-large">No city found matching "<?php echo htmlspecialchars($searchTerm); ?>".</p>
                            <?php else: ?>
                                <p class="section-text body-large">Please enter a city name to search.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </div>
</body>
</html> 