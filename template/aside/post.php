<?php $user = $templateParams["user"]; ?>
<div class="col-md-4">
    <aside class="mt-5">
        <section class="rounded border border-1 bg-<?php echo $theme ?> p-3 mb-3">
            <div class="rounded p-2 d-flex flex-row gap-3 bg-<?php echo $theme ?>">
                <img src="<?php echo PROFILE_PIC_DIR . $user["profile_picture"] ?>" class="rounded-circle avatar preview-picture" alt="Immagine del profilo">
                <div class="flex-grow-1">
                    <div class="user-info">
                        <a href='profile.php?id=<?php echo $post["user_id"] ?>'>
                            <h5 class="h6"><?php echo $user["full_name"] ?></h5>
                            <p class="text-<?php echo $main_color ?> fw-bold" style="display: block; z-index: 100;">@<?php echo $user["username"] ?></p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row flex-wrap justify-content-between gap-3">
                <p class="mt-2"><?php if ($user["description"]) echo $user["description"];
                                else echo "Nessuna descrizione" ?></p>
                <?php
                if (signin_check($dbh))
                    if ($user["id"] != $_SESSION["user_id"]) {
                        $user_followed = $dbh->preparedQuery("CHECK_USER_FOLLOW", $_SESSION["user_id"], $user["id"])[0]["COUNT(*)"];
                ?>
                    <div>
                        <form class="follow-form action-form btn btn-<?php echo $main_color ?>" action="actions/share.php" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $user["id"] ?>">
                            <label>
                                <input class="follow-checkbox" type="checkbox" <?php echo ($user_followed > 0 ? "checked" : "") ?>>
                                <?php require(SVG_DIR . "follow.svg") ?>
                                <span><?php echo ($user_followed > 0 ? "Non seguire" : "Segui") ?></span>
                            </label>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </section>
    <?php require_once('template/footer.php'); ?>
    </aside>
</div>
