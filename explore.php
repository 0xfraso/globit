<?php
require_once 'bootstrap.php';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $search = "%$search%";
    $posts = $dbh->preparedQuery("SEARCH_POSTS", $search);
    $templateParams['search'] = $search;
} elseif (isset($_GET['tag'])) {
    $posts = $dbh->preparedQuery("SELECT_POST_TAG", $_GET["tag"]);
    $templateParams['tag'] = $_GET['tag'];
    $templateParams['title'] = "Esplora - #" . $templateParams['tag'];
} else {
    $posts = $dbh->preparedQuery("SELECT_ALL_POST_TAG");
    $templateParams['title'] = "Esplora";
}

$templateParams['posts'] = $posts;
$templateParams['main'] = "template/main/explore.php";
//$templateParams['header'] = "template/header/home.php";
$templateParams['aside'] = "template/aside/home.php";
$templateParams['layout'] = "template/layout/main.php";

require 'template/base-layout.php';
