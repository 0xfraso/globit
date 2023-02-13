<?php

require_once("../bootstrap.php");

if (isset($_POST["post_body"])) {
    $user_id = $_SESSION["user_id"];
    $post_body = $_POST["post_body"];

    $picture = null;

    if ($_FILES['post_picture']['name'] != "") {
        $picture = $_FILES["post_picture"];
        var_dump($picture);
        list($result, $msg) = uploadImage(POST_PIC_DIR, $picture);
        if ($result == 1) {
            $picture = $msg;
        }
    }
    $success = $dbh->preparedQuery("INSERT_POST", $user_id, $post_body, $picture);

    if ($success) {

        preg_match_all('/#([\w]+)/', $post_body, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $match) {
                $tag = substr($match, 1);
                $tag_exists = $dbh->preparedQuery("CHECK_TAG", $tag)[0]["COUNT(*)"];
                if ($tag_exists == 0) {
                    //non esiste, lo inserisco
                    $tag_id = $dbh->preparedQuery("INSERT_TAG", $tag)['insert_id'];
                } else {
                    // esiste, ricavo id
                    $tag_id = $dbh->preparedQuery("SELECT_TAG", $tag)[0]['id'];
                }

                $dbh->preparedQuery("INSERT_POST_TAG", $success['insert_id'], $tag_id);
            }
        }
        header("location: ../post.php?id=" . $success["insert_id"]);
    } else
        header("location: ../index.php?error=Errore inserimento post!");
}
