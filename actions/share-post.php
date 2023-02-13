<?php

require_once("../bootstrap.php");

if (signin_check($dbh)) {
    if (isset($_POST["post_id"])  && isset($_POST['share_body'])) {
        $success = $dbh->preparedQuery("INSERT_SHARE", $_SESSION['user_id'], $_POST["share_body"], $_POST["post_id"]);

        if ($success) {
            $post_id = $success['insert_id'];
            $success = $dbh->preparedQuery("INSERT_POST_SHARE", $_SESSION['user_id'], $_POST["post_id"]);
            header("location: ../post.php?id=" . $post_id);
        } else {
            header("location: ../index.php?error=" . $success['error']);
        }
    }
} else echo -1;
