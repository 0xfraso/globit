<main class="col-md-8 mt-4">
    <?php
    $posts = $dbh->preparedQuery("SELECT_USER_POSTS", $id);
    $templateParams['show_comments'] = false;
    if ($posts) {
        foreach ($posts as $post) {
            require("template/post-template.php");
        } ?>
        <div class="p-3">Non ci sono altri post.</div>
    <?php } else { ?>
        <div class="p-3">Questo utente non ha ancora pubblicato nessun post.</div>
    <?php } ?>
</main>
