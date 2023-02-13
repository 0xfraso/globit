<?php
$user = $templateParams["user"];
$show_comments = $templateParams["show_comments"];

if ($post['parent_id'] != null) {
    $is_shared = true;
    $shared_post = $dbh->preparedQuery("SELECT_POST", $post['parent_id'])[0];
    $shared_post_user = $dbh->preparedQuery("SELECT_USER_INFO", $shared_post['user_id'])[0];
} else {
    $is_shared = false;
}
?>

<article class="post rounded mb-3 bg-<?php echo $theme ?> rounded border border-1 p-4 ">
    <?php if ($is_shared) { ?>
        <div><span class="fw-bold text-<?php echo $main_color ?>">@<?php echo $user['username'] ?></span> ha condiviso un post</div>
        <hr class="my-3">
    <?php } ?>
    <header class="d-flex flex-row gap-3">
        <img src="<?php echo PROFILE_PIC_DIR . $user["profile_picture"] ?>" class="preview-picture rounded-circle avatar" alt="Immagine del profilo di <?php echo $user['username'] ?>">
        <div class="d-flex flex-row justify-content-between flex-grow-1">
            <div class="user-info">
                <a href='profile.php?id=<?php echo $post["user_id"] ?>'>
                    <h5 class="h6"><?php echo $user["full_name"] ?></h5>
                    <p class="text-<?php echo $main_color ?> fw-bold">@<?php echo $user["username"] ?></p>
                </a>
            </div>
            <p><?php echo timeSince($post["created_at"]) ?></p>
        </div>
    </header>
    <div>
        <p class=" post-body"><?php echo processTags(processLinks($post["body"], $main_color), $main_color) ?></p>
        <?php if ($post["picture"] != null) { ?>
            <img src="<?php echo POST_PIC_DIR . $post["picture"] ?>" class="w-100 mb-3 rounded preview-picture" alt="Immagine post" style="cursor: pointer;">
        <?php };
        if ($is_shared) : ?>
            <article id="post" class="rounded mb-3 bg-<?php echo $theme ?> rounded border border-1 p-4 ">
                <div class="d-flex flex-row gap-3">
                    <img src="<?php echo PROFILE_PIC_DIR . $shared_post_user["profile_picture"] ?>" class="rounded-circle avatar" alt="Immagine del profilo di <?php echo $shared_post_user['username'] ?>">
                    <div class="d-flex flex-row justify-content-between flex-grow-1">
                        <div class="user-info">
                            <h6><?php echo $shared_post_user["full_name"] ?></h6>
                            <p class="text-<?php echo $main_color ?> fw-bold">@<?php echo $shared_post_user["username"] ?></p>
                        </div>
                        <p><?php echo timeSince($shared_post["created_at"]) ?></p>
                    </div>
                </div>
                <div>
                    <p class="post-body"><?php echo processTags(processLinks($shared_post["body"], $main_color), $main_color) ?></p>
                    <?php if ($is_shared) {
                    } ?>
                    <?php if ($shared_post["picture"] != null) { ?>
                        <img src="<?php echo POST_PIC_DIR . $shared_post["picture"] ?>" class="w-100 mb-3 rounded preview-picture" alt="Immagine post" style="cursor: pointer;">
                    <?php }; ?>
                </div>
                <div class="mt-3 show-post">
                    <a href="post.php?id=<?php echo $shared_post['id'] ?>" class="text-<?php echo $main_color ?>">Mostra discussione</a>
                </div>
            </article>
        <?php endif;
        require("template/post-actions.php");
        if ($show_comments) { ?>
            <?php if (signin_check($dbh)) { ?>
                <form class="comment-input-form mt-3 d-flex flex-column" action="actions/comment.php" method="POST">
                    <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                    <input type="hidden" name="post_owner_id" value="<?php echo $post['user_id'] ?>">
                    <div class="form-floating">
                        <textarea style="min-height: 100px" name="post_body" class="form-control border bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" placeholder="Commenta" id="post_body" required></textarea>
                        <label for="post_body">Commenta come <span class="text-<?php echo $main_color ?>"><?php echo $_SESSION['username'] ?></span></label>
                    </div>
                    <div class="align-self-end">
                        <input type="submit" class="btn btn-<?php echo $main_color ?> border-1 rounded mt-1 bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" value="Condividi">
                    </div>
                </form>
            <?php } ?>
            <div class="post-comments">
                <?php
                $post_comments = $dbh->preparedQuery("SELECT_POST_COMMENTS", $post["id"]);
                if ($post_comments) { ?>
                    <hr class="my-2">
                <?php
                    foreach ($post_comments as $comment) {
                        require('template/comment-template.php');
                    }
                } ?>
            </div>
        <?php } else { ?>
            <div class="mt-3 show-post">
                <a href="post.php?id=<?php echo $post['id'] ?>" class="text-<?php echo $main_color ?>">Mostra discussione</a>
            </div>
        <?php } ?>
    </div>
</article>
