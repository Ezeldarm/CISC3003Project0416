<?php
  session_start();
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
  <title><?php echo $cityData['title']; ?></title>
  <link rel="stylesheet" href="./assets/css/cities.css">
<style>
  .attraction-item {
    display: flex;
    margin-bottom: 20px;
    padding: 15px;
    background-color: #f9f9f9;
    border-radius: 8px;
  }
  
  .toggle-attractions {
    text-align: center;
    margin: 20px 0;
  }
  
  .toggle-attractions button {
    background: #3498db;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s;
  }
  
  .toggle-attractions button:hover {
    background: #2980b9;
  }
  
  .attraction-image {
    flex: 0 0 200px;
    margin-right: 20px;
  }
  
  .attraction-image img {
    width: 100%;
    height: auto;
    border-radius: 4px;
  }
  
  .attraction-info {
    flex: 1;
  }
  
  .attraction-name {
    display: block;
    font-size: 18px;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 10px;
    text-decoration: none;
    transition: color 0.3s;
  }
  
  .attraction-name:hover {
    color: #3498db;
    text-decoration: underline;
  }
  
  .attraction-desc {
    color: #7f8c8d;
    line-height: 1.5;
  }
  
  .rating-categories {
    margin-top: 20px;
  }
  
  .rating-item {
    margin-bottom: 15px;
  }
  
  .rating-label {
    display: inline-block;
    width: 80px;
    font-weight: bold;
    color: #2c3e50;
  }
  
  .rating-stars {
    display: inline-block;
  }
  
  .star {
    color: #ddd;
    font-size: 20px;
  }
  
  .star.filled {
    color: #f39c12;
  }
  
  .rating-value {
    margin-left: 10px;
    color: #3498db;
    font-weight: bold;
  }
</style>
</head>

<body>
  
<header class="header">1</header>

<!-- hero -->
<div class="hero" style="background-image: url('<?php echo isset($cityData['hero_image']) ? $cityData['hero_image'] : ''; ?>')">
  <h1><?php echo $cityData['title']; ?></h1>
  <p><?php echo $cityData['description']; ?></p>
</div>

<!-- sidebar -->
<div class="sidebar">
  <ul>
    <li><a href="#overview">overview</a></li>
    <li><a href="#attraction">attraction</a></li>
    <li><a href="#ratings">ratings</a></li>
  </ul>
</div>

<!-- content -->
<div class="content">
  <div id="overview" class="overview">
    <p><?php echo isset($cityData['overview']) ? $cityData['overview'] : '暂无城市概述'; ?></p>
  </div>
  <div id="attraction" class="attraction">
    <?php if(isset($cityData['attractions'])): ?>
      <?php 
        $showAll = isset($_GET['show_all']) && $_GET['show_all'] === 'true';
        $attractionCount = count($cityData['attractions']);
        $displayAttractions = $showAll ? $cityData['attractions'] : array_slice($cityData['attractions'], 0, 3);
      ?>
      <?php foreach($displayAttractions as $attraction): ?>
        <div class="attraction-item">
          <div class="attraction-image">
            <img src="<?php echo $attraction['image']; ?>" alt="<?php echo $attraction['name']; ?>">
          </div>
          <div class="attraction-info">
            <a href="<?php echo $attraction['website']; ?>" class="attraction-name" target="_blank"><?php echo $attraction['name']; ?></a>
            <p class="attraction-desc"><?php echo $attraction['desc']; ?></p>
          </div>
        </div>
      <?php endforeach; ?>
      <?php if($attractionCount > 3): ?>
        <div class="toggle-attractions">
          <button onclick="toggleAttractions()" id="toggleBtn">
            <?php echo $showAll ? '收起' : '展开 (' . ($attractionCount - 3) . '个)' ?>
          </button>
          <script>
            function toggleAttractions() {
              const attractions = document.querySelectorAll('.attraction-item');
              const toggleBtn = document.getElementById('toggleBtn');
              const showAll = !toggleBtn.textContent.includes('收起');
              
              // Update URL parameter to maintain state
              const url = new URL(window.location.href);
              url.searchParams.set('show_all', showAll);
              window.history.pushState({}, '', url);
              
              // Reload the page to apply changes
              window.location.reload();
            }
          </script>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
  <div id="ratings" class="ratings">
    <?php if(isset($cityData['ratings'])): ?>
      <div class="rating-categories">
        <div class="rating-item">
          <span class="rating-label">美食:</span>
          <div class="rating-stars">
            <?php for($i = 1; $i <= $cityData['ratings']['food']; $i++): ?>
              <span class="star filled"></span>
            <?php endfor; ?>
            <?php for($i = 1; $i <= (5 - $cityData['ratings']['food']); $i++): ?>
              <span class="star"></span>
            <?php endfor; ?>
            <span class="rating-value"><?php echo $cityData['ratings']['food']; ?></span>
          </div>
        </div>
        <div class="rating-item">
          <span class="rating-label">购物:</span>
          <div class="rating-stars">
            <?php for($i = 1; $i <= $cityData['ratings']['clothing']; $i++): ?>
              <span class="star filled"></span>
            <?php endfor; ?>
            <?php for($i = 1; $i <= (5 - $cityData['ratings']['clothing']); $i++): ?>
              <span class="star"></span>
            <?php endfor; ?>
            <span class="rating-value"><?php echo $cityData['ratings']['clothing']; ?></span>
          </div>
        </div>
        <div class="rating-item">
          <span class="rating-label">住宿:</span>
          <div class="rating-stars">
            <?php for($i = 1; $i <= $cityData['ratings']['accommodation']; $i++): ?>
              <span class="star filled"></span>
            <?php endfor; ?>
            <?php for($i = 1; $i <= (5 - $cityData['ratings']['accommodation']); $i++): ?>
              <span class="star"></span>
            <?php endfor; ?>
            <span class="rating-value"><?php echo $cityData['ratings']['accommodation']; ?></span>
          </div>
        </div>
        <div class="rating-item">
          <span class="rating-label">交通:</span>
          <div class="rating-stars">
            <?php for($i = 1; $i <= $cityData['ratings']['transport']; $i++): ?>
              <span class="star filled"></span>
            <?php endfor; ?>
            <?php for($i = 1; $i <= (5 - $cityData['ratings']['transport']); $i++): ?>
              <span class="star"></span>
            <?php endfor; ?>
            <span class="rating-value"><?php echo $cityData['ratings']['transport']; ?></span>
          </div>
        </div>
      </div>
    <?php else: ?>
      <p>暂无评分数据</p>
    <?php endif; ?>
  </div>
</div>
<footer class="footer">5</footer>

</body>
</html>