<?php
require("../bootstrap.php");


if (isset($_POST["notification_id"])) {
    $success = $dbh->preparedQuery("DISMISS_NOTIFICATION", $_POST["notification_id"]);

    if ($success) {
        echo 1;
    } else {
        echo -1;
    }
}
