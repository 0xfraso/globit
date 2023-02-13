<?php
$votes_count = $dbh->preparedQuery("SELECT_COMMENT_VOTES_COUNT", $comment["id"])[0]["COUNT(*)"];
$comments_count = count($dbh->preparedQuery("SELECT_NESTED_COMMENTS", $comment['id']));
if (signin_check($dbh))
    $user_voted = $dbh->preparedQuery("CHECK_COMMENT_VOTE", $comment["id"], $_SESSION["user_id"])[0]["COUNT(*)"];
else $user_voted = 0;
?>

<div class="d-flex flex-row flex-wrap gap-3">
    <form class="vote-form action-form" action="actions/vote.php" method="post">
        <input type="hidden" name="comment_id" value="<?php echo $comment["id"] ?>">
        <input type="hidden" name="post_id" value="<?php echo $comment["post_id"] ?>">
        <label for="vote-form-c-<?php echo $comment['id'] ?>">
            <input id="vote-form-c-<?php echo $comment['id'] ?>" class="vote-checkbox" type="checkbox" <?php echo ($user_voted > 0 ? "checked" : "") ?>>
            <?php require(SVG_DIR . "like.svg") ?>
            <span class="vote-count"> <?php echo $votes_count ?> </span>
        </label>
    </form>

    <form class="comment-form action-form">
        <input type="hidden" name="comment_id" value="<?php echo $comment["id"] ?>">
        <input type="hidden" name="post_id" value="<?php echo $comment["post_id"] ?>">
        <input type="hidden" name="post_owner_id" value="<?php echo $comment["post_owner_id"] ?>">
        <label for="comment-form-c-<?php echo $comment['id'] ?>">
            <input id="comment-form-c-<?php echo $comment['id'] ?>" type="button" class="comment-input" value="<?php echo $comment["id"] ?>">
            <?php require(SVG_DIR . "comment.svg") ?>
            <span class="comment-count"> <?php echo $comments_count ?> </span>
        </label>
    </form>
</div>
