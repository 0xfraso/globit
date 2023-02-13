<?php
$user = $dbh->preparedQuery("SELECT_USER_INFO", $_SESSION["user_id"])[0];
?>
<li class="nav-item dropstart">
    <a class="nav-link" href="#" data-bs-toggle="dropdown">
        <img src="<?php echo PROFILE_PIC_DIR . $user['profile_picture'] ?>" class="rounded-circle border border-1 avatar" alt="Immagine del profilo navbar" style="width: 40px; height: 40px;">
    </a>
    <ul class="dropdown-menu rounded border border-1 bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" tabindex="0" onclick="event.stopPropagation()">
        <li>
            <div class="dropdown-header">
                <h6 class="text-<?php echo $opposite_theme ?>">Online come</h6>
                <h6 class="text-<?php echo $main_color ?> fw-bold">@<?php echo $_SESSION["username"] ?></h6>
            </div>
        </li>
        <li>
            <a class="dropdown-item text-<?php echo $opposite_theme ?>" href="profile.php?id=<?php echo $_SESSION["user_id"] ?>">Il mio profilo</a>
        </li>
        <li>
            <a class="dropdown-item text-<?php echo $opposite_theme ?>" href="profile-settings.php">Impostazioni</a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#signoutModal" class="dropdown-item text-<?php echo $opposite_theme ?>">Esci</a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li class="d-flex">
            <canvas class="" height='40' width='100' id="theme-switch"></canvas>
            <label for="checkbox-theme-switch">
                Tema
                <input type="checkbox" id="checkbox-theme-switch" tabindex="0" <?php if ($theme !== 'dark') echo 'checked'; ?>>
            </label>
        </li>
    </ul>
</li>
