<?php
$user_notifications = $dbh->preparedQuery("SELECT_USER_ALL_NOTIFICATIONS", $user['id']);
?>

<main class="col-md-8 mt-4">
    <h4 class="mb-1 px-3 mb-3">Notifiche</h4>
    <ul class="notifications-list list-group rounded border border-1 mb-3 bg-<?php echo $theme ?>">
        <?php foreach ($user_notifications as $notification) { ?>
            <li class="p-3 hover d-flex flex-row justify-content-between align-items-center">
                <a class="notification d-flex flex-column justify-content-between gap-3" href="<?php echo $notification['href'] ?>" data-id="<?php echo $notification['id'] ?>">
                    <span class="<?php echo ($notification['seen'] ? "" : "fw-bold text-$main_color") ?>"><?php echo $notification['content'] ?></span>
                    <span class="text-<?php echo $opposite_theme ?>"><?php echo timeSince($notification['created_at']) ?></span>
                </a>

                <a href="#" class="notification-delete text-<?php echo $main_color ?> cursor-pointer">Cancella</a>
            </li>
        <?php } ?>
    </ul>
</main>
