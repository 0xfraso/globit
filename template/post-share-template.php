<article id="post" class="rounded mb-3 bg-<?php echo $theme ?>">
    <div class="rounded hover border border-1 p-4 d-flex flex-row gap-3 bg-<?php echo $theme ?>">
        <img src="<?php echo PROFILE_PIC_DIR . $user["profile_picture"] ?>" class="rounded-circle avatar" alt="Immagine del profilo <?php echo $user['username'] ?>>">
        <div class="flex-grow-1">
            <div class="d-flex flex-row justify-content-between">
                <div class="user-info">
                    <a href='profile.php?id=<?php echo $post["user_id"] ?>'>
                        <h6><?php echo $user["full_name"] ?>
                            <span class="ms-1 badge text-<?php echo $theme ?> bg-<?php echo $main_color; ?>">Autore</span>
                        </h6>
                        <p class="text-<?php echo $main_color ?> fw-bold" style="display: block; z-index: 100;">@<?php echo $user["username"] ?></p>
                    </a>
                </div>
                <p><?php echo timeSince($post["created_at"]) ?></p>
            </div>
            <p class="post-body"><?php echo processLinks($post["body"], $main_color) ?></p>
            <?php
            require("template/post-actions.php");
            ?>

            <?php if ($show_comments) : ?>
                <div class="post-comments">
                    <?php
                    $post_comments = $dbh->preparedQuery("SELECT_POST_COMMENTS", $post["id"]);
                    foreach ($post_comments as $comment) {
                        require('template/comment-template.php');
                    } ?>
                </div>
            <?php else : ?>
                <div class="mt-3">
                    <a href="post.php?id=<?php echo $post['id'] ?>" class="text-<?php echo $main_color ?>">Mostra discussione</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>
