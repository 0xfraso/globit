<main id="#homeMain" class="col-md-8 mt-4">
    <?php
    if (isset($templateParams['tag'])) : ?>
        <h4 class="mb-1 px-3 mb-3">Tutti i post per <span class="text-<?php echo $main_color ?>">#<?php echo $templateParams['tag'] ?></span></h4>
    <?php elseif (isset($templateParams['search'])) : ?>
        <h4 class="mb-1 px-3 mb-3">Risultato della ricerca per <span class="text-<?php echo $main_color ?>"><?php echo str_replace("%", "\"", $templateParams['search']) ?></span></h4>
    <?php else : ?>
        <h4 class="mb-1 px-3 mb-3">Esplora</h4>
    <?php endif;
    if (isset($_GET["error"])) : ?>
        <div class="text-white p-3 rounded bg-danger mb-3 ">
            <?php
            echo $_GET['error'];
            ?>
        </div>
    <?php endif;

    $posts = $templateParams['posts'];
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
