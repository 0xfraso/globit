<?php

require_once("../bootstrap.php");


if (isset($_POST["user_id"])) {
    $user_id = intval($_POST["user_id"]);
    $count = $dbh->preparedQuery("CHECK_USER_FOLLOW", $_SESSION['user_id'], $user_id)[0]["COUNT(*)"];

    if ($count == 0) {
        $success = $dbh->preparedQuery("ADD_FOLLOWER", $_SESSION["user_id"], $user_id);

        if ($success) {
            $dbh->preparedQuery("INSERT_NOTIFICATION", $user_id, $_SESSION["username"] . " ha iniziato a seguirti.", "profile.php?id=" . $_SESSION["user_id"]);
            echo 1;
        } else {
            echo -1;
        }
    } else {
        $success = $dbh->preparedQuery("DELETE_FOLLOWER", $_SESSION["user_id"], $user_id);

        if ($success) {
            echo 0;
        } else {
            echo -1;
        }
    }
}
