<?php $logged_in = signin_check($dbh); ?>

<nav class="navbar navbar-expand-md navbar-<?php echo $theme ?> bg-<?php echo $theme ?> border sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <?php require(SVG_DIR . 'logo.svg'); ?>
            <span class="h4 fw-bold d-none d-md-inline-block" id="logo">GLOBIT</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link <?php isActive('index.php', $main_color); ?>" href="index.php">Home </a> </li>
                <li class="nav-item"><a class="nav-link <?php isActive('explore.php', $main_color); ?>" href="explore.php">Esplora</a></li>
            </ul>
            <form action="explore.php" method="get" class="d-flex ms-2">
                <input class="form-control me-1 bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" type="search" name='search' placeholder="Cerca" aria-label="Search" style="max-width: 150px;">
            </form>
            <ul class="navbar-nav ms-auto">
                <?php
                if ($logged_in) {
                    require_once("template/navbar/navbar-notifications.php");
                    require_once("template/navbar/navbar-user.php");
                } else {
                    require_once("template/navbar/navbar-login.php");
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
