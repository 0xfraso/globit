<div class="col-md-4 mt-4">
    <aside>
        <?php
        if (isset($_SESSION["user_id"])) {
            $suggested_users = $dbh->preparedQuery("SELECT_SUGGESTED_USERS", $_SESSION["user_id"], 4);
            if (count($suggested_users)) { ?>
                <section>
                    <h4 class="px-3 mb-3">Utenti consigliati</h4>
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
