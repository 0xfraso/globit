<?php
require_once 'bootstrap.php';

if (isset($_GET["id"])) {
    $post = $dbh->preparedQuery("SELECT_POST", $_GET["id"])[0];
    if ($post != null)
        $user = $dbh->preparedQuery("SELECT_USER_INFO", $post['user_id'])[0];
    else
        die("Post non trovato!");
} else {
    die("Post non trovato!");
}

$templateParams['show_comments'] = true;
$templateParams['user'] = $user;
$templateParams['title'] = "Post";
$templateParams['main'] = "template/main/post.php";
$templateParams['aside'] = "template/aside/post.php";
$templateParams['layout'] = "template/layout/main.php";

require 'template/base-layout.php';
