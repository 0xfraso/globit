<?php

require("../bootstrap.php");

if (signin_check($dbh)) {
    $result = $dbh->preparedQuery("SELECT_USER_ALL_NOTIFICATIONS", $_SESSION["user_id"]);

    $result = array_map(function ($notification) {
        $notification['created_at'] = timeSince($notification['created_at']);
        return $notification;
    }, $result);

    echo json_encode($result);
}
