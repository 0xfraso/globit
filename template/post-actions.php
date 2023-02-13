<?php
$votes_count = $dbh->preparedQuery("SELECT_POST_VOTES_COUNT", $post["id"])[0]["COUNT(*)"];
$comments_count = $dbh->preparedQuery("SELECT_POST_COMMENTS_COUNT", $post["id"])[0]["COUNT(*)"];
$shares_count = count($dbh->preparedQuery("SELECT_POST_SHARES", $post["id"]));
$signed_in = signin_check($dbh);
if ($signed_in)
    $user_voted = $dbh->preparedQuery("CHECK_POST_VOTE", $post["id"], $_SESSION["user_id"])[0]["COUNT(*)"];
else $user_voted = 0;
?>

<div class="post-actions d-flex flex-row flex-wrap gap-3">
    <form class="vote-form action-form" action="actions/vote.php" method="POST">
        <label for="vote-form-p-<?php echo $post['id'] ?>">
            <input id="vote-form-p-<?php echo $post['id'] ?>" class="vote-checkbox" type="checkbox" <?php echo ($user_voted > 0 ? "checked" : "") ?>>
            <?php require(SVG_DIR . "like.svg") ?>
            <span class="vote-count"> <?php echo $votes_count ?> </span>
        </label>
        <input type="hidden" name="post_id" value="<?php echo $post["id"] ?>">
    </form>

    <form class="comment-form action-form">
        <label for="comment-form-p-<?php echo $post['id'] ?>">
            <input id="comment-form-p-<?php echo $post['id'] ?>" class="comment-input" type="button" value="<?php echo $post['id'] ?>">
            <?php require(SVG_DIR . "comment.svg") ?>
            <span class="comment-count"> <?php echo $comments_count ?> </span>
        </label>
        <input type="hidden" name="post_id" value="<?php echo $post["id"] ?>">
        <input type="hidden" name="post_owner_id" value="<?php echo $post["user_id"] ?>">
    </form>

    <form class="share-form action-form" action="actions/share.php" method="POST">
        <label for="share-form-p-<?php echo $post['id'] ?>">
            <input id="share-form-p-<?php echo $post['id'] ?>" type="button" class="share-input" value="<?php echo $post['id'] ?>">
            <?php require(SVG_DIR . "share.svg") ?>
            <span class="share-count"> <?php echo $shares_count ?> </span>
        </label>
        <input type="hidden" name="post_id" value="<?php echo $post["id"] ?>">
    </form>
</div>

<script>
    $(document).on('click', '.comment-form', function() {
        const $form = $(this)
        $.ajax({
            url: 'actions/check-login.php',
            type: 'post',
            success: function(response) {
                if (response != 1) {
                    $('#nav-login-dropdown').dropdown('show')
                    return
                }
                const post_id = $form.find("input[name=post_id]").val()
                const post_owner_id = $form.find("input[name=post_owner_id]").val()
                const comment_id = $form.find("input[name=comment_id]").val()
                const parent_id = $form.find("input[name=parent_id]").val()

                if ($form.parent("div").siblings(".comment-input-form").length === 0) {
                    const comment_form = $(`
                            <form class="comment-input-form mt-3 d-flex flex-column" action="actions/comment.php" method="POST">
                                <input type="hidden" name="post_id" value="${post_id}">
                                <input type="hidden" name="post_owner_id" value="${post_owner_id}">
                                <div class="form-floating">
                                    <textarea style="height: 5rem" name="post_body" class="form-control border bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" placeholder="Commenta" id="post_body" required></textarea>
                                    <label for="post_body">Commenta 
                                        <?php if (signin_check($dbh)) : ?> come <span class="text-<?php echo $main_color ?>"><?php echo $_SESSION['username'] ?></span> <?php endif; ?>
                                    </label>
                                </div>
                                <div class="align-self-end">
                                    <input type="submit" class="btn btn-<?php echo $main_color ?> border-1 rounded mt-1 bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" value="Condividi">
                                </div>
                            </form>
                            `)

                    if (comment_id !== undefined && comment_id !== "")
                        comment_form.append(`<input type='hidden' name='comment_id' value=${comment_id}>`)

                    if (parent_id !== undefined && parent_id !== "")
                        comment_form.append(`<input type='hidden' name='parent_id' value=${parent_id}>`)

                    $form.parent("div").after(comment_form)
                    $form.parent("div").siblings(".comment-input-form").find('textarea').focus()
                } else {
                    $form.parent("div").siblings(".comment-input-form").find('textarea').focus()
                }
            }
        });
    })

    $('.share-form').click(function(e) {
        const form = $(this)
        $.ajax({
            url: 'actions/check-login.php',
            type: 'post',
            success: function(response) {
                if (response != 1) {
                    $('#nav-login-dropdown').dropdown('show')
                    return
                }
                const post_id = form.find('input[name=post_id]').val()
                const post = form.parents('.post').clone()

                post.find(".post-comments").remove()
                post.find(".post-actions").remove()
                post.find(".comment-input-form").remove()
                post.find(".show-post").remove()
                post.children("div").removeClass('hover')

                const sharePostTemplate = $(`
                        <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="false">
                            <div class="modal-dialog modal-dialog-centered">
                                <form enctype="multipart/form-data" id="insertSharePostForm" action="actions/share-post.php" method="POST" class="share-modal-form modal-content bg-<?php echo $theme ?>">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="shareModalLabel">Condividi post</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="post_id" value="${post_id}">
                                        <textarea name="share_body" class="form-control mb-3 bg-<?php echo $theme ?> border-0 text-<?php echo $opposite_theme ?>" id="post-body" placeholder="Che succede?" style="height: 6rem;" required></textarea>
                                        ${post.html()}
                                    </div>
                                    <div class="modal-footer border-top-0">
                                        <button type="submit" class="btn btn-<?php echo $main_color ?>" data-bs-dismiss="modal" aria-label="Fatto">Fatto</button>
                                    </div>
                                </form>
                            </div>
                        </div> `)

                if (form.find('#shareModal').length === 0)
                    form.append($(sharePostTemplate))

                form.find("#shareModal").modal('show')

                $("#shareModal").on('hidden.bs.modal', function(e) {
                    $('#shareModal').remove()
                })
            }
        })
    });
</script>
