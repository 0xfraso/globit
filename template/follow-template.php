<?php
$user_followed = $dbh->preparedQuery("CHECK_USER_FOLLOW", $_SESSION["user_id"], $user["id"])[0]["COUNT(*)"];
?>
<article class="p-3 d-flex justify-content-between flex-wrap">
    <div class="d-flex flex-row gap-3">
        <img src="<?php echo PROFILE_PIC_DIR . $user["profile_picture"] ?>" class="preview-picture rounded-circle avatar" alt="Immagine del profilo <?php echo $user['username'] ?>">
        <div class="d-flex flex-row justify-content-between flex-grow-1">
            <div class="user-info">
                <a href='profile.php?id=<?php echo $user["id"] ?>'>
                    <p class="fw-bolder"><?php echo $user["full_name"] ?></p>
                    <p class="text-<?php echo $main_color ?> fw-bold" style="display: block; z-index: 100;">@<?php echo $user["username"] ?></p>
                </a>
            </div>
        </div>
    </div>

    <div>
        <form class="follow-form action-form bg-<?php echo $main_color ?> p-2 rounded text-<?php echo $theme ?>" action="actions/share.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $user["id"] ?>">
            <label for="follow-checkbox-u-<?php echo $user['id'] ?>">
                <input id="follow-checkbox-u-<?php echo $user['id'] ?>" class="follow-checkbox" type="checkbox" <?php echo ($user_followed > 0 ? "checked" : "") ?>>
                <?php require(SVG_DIR . "follow.svg") ?>
                <span><?php echo ($user_followed > 0 ? "Non seguire" : "Segui") ?></span>
            </label>
        </form>
    </div>
</article>
