<?php
require_once("../bootstrap.php");

if (signin_check($dbh)) {
    if (isset($_POST["post_id"])) {

        $user_id = $_SESSION["user_id"];
        $post_id = $_POST["post_id"];
        $count = $dbh->preparedQuery("CHECK_POST_VOTE", $post_id, $_SESSION["user_id"])[0]["COUNT(*)"];

        if ($count == 0) {
            $success = $dbh->preparedQuery("VOTE_POST", $user_id, $post_id);

            if ($success) {
                $post_owner = $dbh->preparedQuery("SELECT_POST", $post_id)[0]["user_id"];
                if ($post_owner != $user_id)
                    $dbh->preparedQuery("INSERT_NOTIFICATION", $post_owner, $_SESSION['username'] . " ha appena votato il tuo post.", "post.php?id=" . $post_id);
                echo 1;
            } else {
                echo -1;
            }
        } else {
            $success = $dbh->preparedQuery("UNVOTE_POST", $user_id, $post_id);

            if ($success) {
                echo 0;
            } else {
                echo -1;
            }
        }
    } else if (isset($_POST["comment_id"])) {
        $user_id = $_SESSION["user_id"];
        $comment_id = $_POST["comment_id"];
        $post_id = $_POST["post_id"];
        $count = $dbh->preparedQuery("CHECK_COMMENT_VOTE", $comment_id, $_SESSION["user_id"])[0]["COUNT(*)"];

        if ($count == 0) {
            $success = $dbh->preparedQuery("VOTE_COMMENT", $user_id, $comment_id);

            if ($success) {
                $comment_owner = $dbh->preparedQuery("SELECT_COMMENT", $comment_id)[0]["user_id"];
                if ($comment_owner != $user_id)
                    $dbh->preparedQuery("INSERT_NOTIFICATION", $comment_owner, $_SESSION['username'] . " ha appena votato il tuo commento.", "post.php?id=" . $post_id);
                echo 1;
            } else {
                echo -1;
            }
        } else {
            $success = $dbh->preparedQuery("UNVOTE_COMMENT", $user_id, $comment_id);

            if ($success) {
                echo 0;
            } else {
                echo -1;
            }
        }
    }
} else echo -1;
