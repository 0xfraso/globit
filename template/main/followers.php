<?php $user = $templateParams["user"]; ?>
<main id="#homeMain" class="col-md-8 py-4">

    <h4 class="mt-4 px-3 mb-3">Seguaci</h4>
    <?php
    $followers = $dbh->preparedQuery("SELECT_FOLLOWERS", $user["id"]);
    if ($followers)
        foreach ($followers as $user) {
            $user = $dbh->preparedQuery("SELECT_USER_INFO", $user["follower_id"])[0];
    ?>
        <article class="rounded p-3 bg-<?php echo $theme ?> mb-3">
            <div class="d-flex flex-row gap-3">
                <img src="<?php echo PROFILE_PIC_DIR . $user["profile_picture"] ?>" class="rounded-circle avatar border border-1 preview-picture" alt="Immagine del profilo">
                <a href='profile.php?id=<?php echo $user["id"] ?>' class="d-flex flex-column flex-grow-1">
                    <h6><?php echo $user["full_name"] ?></h6>
                    <p class="text-<?php echo $main_color ?>">@<?php echo $user["username"] ?> </p>
                </a>
            </div>
        </article>
    <?php   }
    else echo $user["full_name"] . " non è seguito da nessun utente." ?>
</main>
