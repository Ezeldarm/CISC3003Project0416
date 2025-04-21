<?php
session_start();
?>

<header class="header" data-header>
    <div class="container">
        <a href="#" class="logo">
            China Travel<br>
            Starter Pack
        </a>
        <nav class="navbar" data-navbar>
            <div class="navbar-wrapper">
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