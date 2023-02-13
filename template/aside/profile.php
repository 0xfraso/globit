<?php
$user = $templateParams["user"];
$followed = $dbh->preparedQuery("SELECT_FOLLOWED", $user["id"]);
$followers = $dbh->preparedQuery("SELECT_FOLLOWERS", $user["id"]);
?>
<div class="col-md-4">
    <aside class="mt-2">
        <img src="<?php echo PROFILE_PIC_DIR . $user["profile_picture"] ?>" style="object-fit: cover;" class="preview-picture profile-picture border border-5 mt-5 bg-white" height="207" width="208" alt="Immagine del profilo">
        <section class="mb-3">
            <h3 class="mt-5"><?php echo $user["full_name"]; ?></h3>
            <h4 class="text-<?php echo $main_color ?> mt-3 fw-bold">@<?php echo $user["username"] ?></h4>

            <div class="d-flex flex-row gap-4 py-3">
                <a href="followed.php?id=<?php echo $user["id"] ?>">
                    <p><?php echo count($followed); ?></p>
                    <p class='text-<?php echo $main_color ?>'>Seguiti</p>
                </a>
                <a href="followers.php?id=<?php echo $user["id"] ?>">
                    <p class="followers-count"><?php echo count($followers); ?></p>
                    <p class='text-<?php echo $main_color ?>'>Seguaci</p>
                </a>
            </div>
            <a class="text-<?php echo $main_color ?>" href="mailto:<?php echo $user['email'] ?>"><?php echo $user['email'] ?></a>
            <p class="mt-3">Iscritto <?php echo timeSince($user["created_at"]) ?></p>
            <p class="mt-2"><?php if ($user["description"]) echo $user["description"];
                            else echo "Nessuna descrizione" ?></p>
            <?php
            if (signin_check($dbh))
                if ($user["id"] != $_SESSION["user_id"]) {
                    $user_followed = $dbh->preparedQuery("CHECK_USER_FOLLOW", $_SESSION["user_id"], $user["id"])[0]["COUNT(*)"];
            ?>
                <hr class='my-3 w-75'>
                <form class="follow-form action-form btn btn-<?php echo $main_color ?>" action="actions/share.php" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $user["id"] ?>">
                    <label>
                        <input class="follow-checkbox" type="checkbox" <?php echo ($user_followed > 0 ? "checked" : "") ?>>
                        <?php require(SVG_DIR . "follow.svg") ?>
                        <span><?php echo ($user_followed > 0 ? "Non seguire" : "Segui") ?></span>
                    </label>
                </form>
            <?php } else { ?>
                <a class="text-<?php echo $main_color ?>" href="profile-settings.php">Impostazioni profilo</a>
            <?php } ?>
        </section>
    <?php require_once('template/footer.php'); ?>
    </aside>
</div>
