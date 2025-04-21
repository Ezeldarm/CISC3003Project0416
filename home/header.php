

<header class="header" data-header>
    <div class="container">
        <a href="#" class="logo">
            China Travel<br>
            Starter Pack
        </a>
        
        <nav class="navbar" data-navbar>
        
            <div class="navbar-wrapper">
            
                <div class="topnav">
                    <div class="search-container">
                        <form action="">
                            <div class="search-wrapper">
                                <input type="text" placeholder="Search..." name="search">
                                <button type="submit" class="search-btn" aria-label="Search">
                                    <img src="./assets/images/magnifying-glass.png" alt="搜尋" class="search-icon">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mobile-sidebar">
                    <nav class="side-nav">
                        <ul class="nav-list">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
                                    <span class="material-symbols-rounded">home</span>
                                    <span class="nav-text">Home</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="cities.php" class="nav-link <?php echo $current_page == 'cities.php' ? 'active' : ''; ?>">
                                    <span class="material-symbols-rounded">location_city</span>
                                    <span class="nav-text">Cities</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="mylist.php" class="nav-link <?php echo $current_page == 'mylist.php' ? 'active' : ''; ?>">
                                    <span class="material-symbols-rounded">list</span>
                                    <span class="nav-text">My List</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="mypost.php" class="nav-link <?php echo $current_page == 'mypost.php' ? 'active' : ''; ?>">
                                    <span class="material-symbols-rounded">post</span>
                                    <span class="nav-text">My Post</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="profile.php" class="nav-link <?php echo $current_page == 'profile.php' ? 'active' : ''; ?>">
                                    <span class="material-symbols-rounded">person</span>
                                    <span class="nav-text">My Profile</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <?php 
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <span style="margin-right: 1rem; color: white;">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                    <button class="btn-link logout-btn label-medium" onclick="location.href='logout.php'">Exit</button>
                <?php else: ?>
                    <button class="btn-link login-btn label-medium" onclick="location.href='login.php'">Login</button>
                    <button class="btn register-btn btn-fill label-medium" onclick="location.href='register.html'">Register</button>
                <?php endif; ?>
            </div>
        </nav>
        <button class="nav-toggle-btn icon-btn" aria-label="toggle navbar" data-nav-toggler>
            <span class="material-symbols-rounded open" aria-hidden="true">menu</span>
            <span class="material-symbols-rounded close" aria-hidden="true">close</span>
        </button>
    </div>
</header>