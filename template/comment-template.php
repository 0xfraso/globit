<?php
$user = $dbh->preparedQuery("SELECT_USER_INFO", $comment["user_id"])[0];
?>
<article class="pt-4 comment" data-id="<?php echo $comment['id'] ?>">
    <div class="d-flex flex-row gap-2">
        <div class="d-flex flex-column">
            <img src="<?php echo PROFILE_PIC_DIR . $user["profile_picture"] ?>" class="rounded-circle avatar" alt="Immagine del profilo <?php echo $user['username'] ?>">
            <div class="collapse-comment align-self-center h-100"> </div>
        </div>
        <div class="flex-grow-1">
            <div class="d-flex flex-row justify-content-between mb-3">
                <div class="user-info">
                    <a href='profile.php?id=<?php echo $comment["user_id"] ?>'>
                        <h6><?php echo $user["full_name"] ?>
                            <?php if ($user['id'] == $comment["post_owner_id"]) : ?>
                                <span class="ms-1 badge text-<?php echo $theme ?> bg-<?php echo $main_color; ?>">Autore</span>
                            <?php endif; ?>
                        </h6>
                        <p class="text-<?php echo $main_color ?> fw-bold" style="display: block; z-index: 100;">@<?php echo $user["username"] ?></p>
                    </a>
                </div>
                <p><?php echo timeSince($comment["created_at"]) ?></p>
            </div>
            <div class="comment-body">
                <p><?php echo processTags(processLinks($comment["body"], $main_color), $main_color) ?></p>
                <?php require("template/comment-actions.php"); ?>
                <?php $nested_comments = $dbh->preparedQuery("SELECT_NESTED_COMMENTS", $comment['id']);
                foreach ($nested_comments as $comment) {
                    require('template/comment-template.php');
                } ?>
            </div>
        </div>
    </div>
</article>
