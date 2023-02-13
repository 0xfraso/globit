<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered">
        <form enctype="multipart/form-data" id="insertPostForm" action="actions/insert-post.php" method="POST" class="modal-content bg-<?php echo $theme ?>">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="postModalLabel">Crea post</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="post_body">Inserisci testo</label>
                <textarea name="post_body" class="form-control bg-<?php echo $theme ?> border-0 text-<?php echo $opposite_theme ?>" id="post_body" placeholder="Che succede?" style="height: 6rem;" required></textarea>
            </div>
            <div class="modal-footer border-top-0 d-flex flex-row justify-content-between">
                <label for="post_picture">Immagine</label>
                <input name="post_picture" type="file" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="post_picture">
                <button type="submit" class="btn btn-<?php echo $main_color ?>" data-bs-dismiss="modal" aria-label="Fatto">Fatto</button>
            </div>
        </form>
    </div>
</div>
