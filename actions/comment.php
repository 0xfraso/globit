<?php
require("../bootstrap.php");

if (signin_check($dbh)) {
    if (isset($_POST["post_body"]) && isset($_POST["post_id"]) && isset($_POST["post_owner_id"])) {
        $user_id = $_SESSION["user_id"];
        $post_id = $_POST["post_id"];
        $post_owner_id = $_POST["post_owner_id"];
        $post_body = $_POST["post_body"];

        if (isset($_POST["comment_id"])) {
            $parent_id = $_POST["comment_id"];
        } else {
            $parent_id = null;
        }

        $success = $dbh->preparedQuery("INSERT_COMMENT", $post_id, $user_id, $post_body, $parent_id, $post_owner_id);

        if ($success) {
            if ($post_owner_id != $user_id)
                $dbh->preparedQuery("INSERT_NOTIFICATION", $post_owner_id, $_SESSION['username'] . " ha aggiunto un commento al tuo post", "post.php?id=" . $post_id);

            if ($parent_id != null) {
                $comment_owner_id = $dbh->preparedQuery("SELECT_COMMENT", $parent_id)[0]["user_id"];
                if ($comment_owner_id != $user_id)
                    $dbh->preparedQuery("INSERT_NOTIFICATION", $comment_owner_id, $_SESSION['username'] . " ha risposto al tuo commento sul post", "post.php?id=" . $post_id);
            }

            header("location: ../post.php?id=" . $post_id);
        }
    } else {
        echo "Errore inserimento commento.";
    }
} else echo -1;
