<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<aside class="sidebar">
    <nav class="side-nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>" style="pointer-events: auto;">
                    <span class="material-symbols-rounded">home</span>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="cities.php" class="nav-link <?php echo $current_page == 'cities.php' ? 'active' : ''; ?>" style="pointer-events: auto;">
                    <span class="material-symbols-rounded">location_city</span>
                    <span class="nav-text">Cities</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="mylist.php" class="nav-link <?php echo $current_page == 'mylist.php' ? 'active' : ''; ?>" style="pointer-events: auto;">
                    <span class="material-symbols-rounded">list</span>
                    <span class="nav-text">My List</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="mypost.php" class="nav-link <?php echo $current_page == 'mypost.php' ? 'active' : ''; ?>" style="pointer-events: auto;">
                    <span class="material-symbols-rounded">post</span>
                    <span class="nav-text">My Post</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="profile.php" class="nav-link <?php echo $current_page == 'profile.php' ? 'active' : ''; ?>" style="pointer-events: auto;">
                    <span class="material-symbols-rounded">person</span>
                    <span class="nav-text">My Profile</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>