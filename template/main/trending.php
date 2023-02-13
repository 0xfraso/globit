<main class="col-md-8 mt-4">
    <h4 class="mb-1 px-3 mb-3">In tendenza</h4>
    <div class="rounded border border-1 mb-3 bg-<?php echo $theme ?>">
        <?php
        $tags = $templateParams['tags'];

        foreach ($tags as $tag) {
            require('template/trending-template.php');
        }
        ?>
    </div>
</main>
