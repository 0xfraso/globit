<?php $is_user_logged = signin_check($dbh); ?>
<main id="#homeMain" class="col-md-8 mt-4">
    <?php
    if (isset($_GET["error"])) : ?>
        <div class="text-white p-3 rounded bg-danger mb-3 ">
            <?php
            echo $_GET['error'];
            ?>
        </div>
    <?php endif;
    if (isset($_GET["msg"])) : ?>
        <div class="text-white p-3 rounded bg-success mb-3 ">
            <?php
            echo $_GET['msg'];
            ?>
        </div>
    <?php endif;
    if ($is_user_logged) {
        $profile_picture = $dbh->preparedQuery("SELECT_USER_INFO", $_SESSION["user_id"])[0]["profile_picture"];
    ?>
        <div id='post-form' class="d-flex flex-row align-items-center rounded border border-1 bg-<?php echo $theme ?> p-3 mb-3 ">
            <a href='profile.php?id=<?php echo $_SESSION["user_id"] ?>'>
                <img src="<?php echo PROFILE_PIC_DIR . $profile_picture ?>" class="me-3 rounded-circle avatar" alt="Immagine del profilo">
            </a>

            <a href='#' data-bs-toggle="modal" data-bs-target="#postModal" class="hover rounded border border-1 bg-<?php echo $theme ?> p-3 w-100 d-flex align-items-center gap-2">
                <?php require(SVG_DIR . "edit.svg") ?>
                Posta qualcosa..
            </a>
        </div>
    <?php }
    if ($is_user_logged) {
        $posts = $dbh->preparedQuery("SELECT_USER_FEED", $_SESSION['user_id'], $_SESSION['user_id']);
    } else {
        $posts = $dbh->preparedQuery("SELECT_ALL_POSTS");
    }

    $templateParams['show_comments'] = false;
    if ($posts) {
        foreach ($posts as $post) {
            $templateParams["user"] = $dbh->preparedQuery("SELECT_USER_INFO", $post["user_id"])[0];
            require('template/post-template.php');
        } ?>
        <div class="p-3">Non ci sono altri post.</div>
    <?php } else { ?>
        <div class="p-3">Nessun post trovato.</div>
    <?php } ?>

</main>
