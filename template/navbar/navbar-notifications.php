<li class="nav-item dropstart" style="margin-top: 4px;">
    <a href="#" class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
        <?php
        require(SVG_DIR . "notification.svg");

        $notifications = $dbh->preparedQuery("SELECT_USER_UNSEEN_NOTIFICATIONS", $_SESSION["user_id"]);
        ?>

        <span style="<?php echo (count($notifications) ? "" : "display: none") ?>" class="notifications-count badge rounded-pill badge-notification text-<?php echo $theme ?> bg-<?php echo $main_color ?>"><?php echo count($notifications) ?></span>

    </a>
    <ul class="dropdown-menu rounded border border-1 bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" aria-labelledby="dropdown-header">
        <li>
            <div class="dropdown-header text-<?php echo $opposite_theme ?> fw-bold">
                <h6 id="dropdown-header">Notifiche</h6>
            </div>
        </li>
        <li>
            <ul class="notifications-dropdown list-unstyled">
                <?php
                if (count($notifications) > 0) {
                    foreach ($notifications as $notification) { ?>
                        <li>
                            <div class="dropdown-item">
                                <a id="notification-<?php echo $notification['id'] ?>" class="notification text-<?php echo $opposite_theme ?>" href="<?php echo $notification['href'] ?>" data-id="<?php echo $notification['id'] ?>">
                                    <?php echo $notification['content'] ?>
                                </a>
                            </div>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li>
                        <div class="dropdown-item text-<?php echo $opposite_theme ?>">Non ci sono nuove notifiche</div>
                    </li>
                <?php } ?>
            </ul>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item text-<?php echo $main_color ?>" href="notifications.php">Vedi tutte</a>
        </li>
    </ul>
</li>

<script>
    // Periodically check for new notifications every 10 seconds
    setInterval(function() {
        $.ajax({
            url: "actions/get-notifications.php",
            type: "GET",
            success: function(data) {
                let list = $(".notifications-list")
                $(list).empty()
                let notifications = JSON.parse(data)
                notifications.forEach(function(notification) {
                    list.append(`
                        <article class="p-3 hover d-flex flex-row justify-content-between align-items-center">
                            <a id="notification" class="d-flex flex-column justify-content-between gap-3" href="${notification.href}" data-id="${notification.id}">
                                <span class="${notification.seen ? "" : "fw-bold text-<?php echo $main_color ?>"} ?>">${notification.content}</span>
                                <span class="text-<?php echo $opposite_theme ?>">${notification.created_at}</span>
                            </a>

                            <div>
                                <a href="#" class="text-<?php echo $main_color ?> cursor-pointer">Cancella</a>
                            </div>
                        </article>
                        `)
                });
            }
        });

        $.ajax({
            url: "actions/check-notifications.php",
            type: "GET",
            success: function(data) {
                let dropdown = $(".notifications-dropdown")
                dropdown.empty()
                let count = $(".notifications-count")
                let notifications = JSON.parse(data)
                //console.log(data)
                let notifications_count = Object.keys(notifications).length
                if (notifications_count > 0) {
                    count.show()
                    count.text(notifications_count);
                    notifications.forEach(function(notification) {
                        dropdown.append(` 
                        <li>
                            <div class="dropdown-item">
                                <a id="notification" class="text-<?php echo $opposite_theme ?>" href="${notification.href}" data-id=${notification.id}>
                                ${notification.content}
                                </a>
                            </div>
                        </li> 
                    `);
                    });
                } else {
                    count.hide()
                    dropdown.empty()
                    dropdown.append(`
                        <li>
                            <div class="dropdown-item text-<?php echo $opposite_theme ?>">Non ci sono nuove notifiche</div>
                        <li>`)
                }
            }
        });
    }, 5000);
</script>
