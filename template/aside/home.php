<div class="col-md-4">
    <aside class="mt-4">
        <?php
        $tags = $dbh->preparedQuery("SELECT_TRENDING_TAGS", 3);
        if ($tags) { ?>
            <section>
                <h4 class="mb-1 px-3 mb-3">In tendenza</h4>
                <div class="rounded border border-1 bg-<?php echo $theme ?> mb-3">
                    <?php foreach ($tags as $tag) {
                        $templateParams['tag'] = $tag;
                        require("template/trending-template.php");
                    } ?>
                </div>
                <a href="trending.php" class="p-3 text-<?php echo $main_color; ?>">Mostra tutti..</a>
            </section>
        <?php } ?>
        <?php
        if (signin_check($dbh)) {
            $suggested_users = $dbh->preparedQuery("SELECT_SUGGESTED_USERS", $_SESSION["user_id"], 4);
            if ($suggested_users) { ?>
                <section>
                    <h4 class="mt-4 px-3 mb-3">Utenti consigliati</h4>
                    <div class="rounded border border-1 bg-<?php echo $theme ?> mb-3">
                        <?php
                        foreach ($suggested_users as $user) {
                            require('template/follow-template.php');
                        }
                        ?>
                    </div>
                </section>
        <?php };
        } ?>
    <?php require_once('template/footer.php'); ?>
    </aside>
</div>
