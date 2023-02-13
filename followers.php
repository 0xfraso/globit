<?php
require_once 'bootstrap.php';

if (isset($_GET["id"])) {
    $user = $dbh->preparedQuery("SELECT_USER_INFO", $_GET['id'])[0];
} else {
    die("Could not find selected user!");
}

$templateParams['user'] = $user;
$templateParams['title'] = $user["username"] . " - Seguaci";
$templateParams['main'] = "template/main/followers.php";
$templateParams['aside'] = "template/aside/profile.php";
$templateParams['layout'] = "template/layout/inverted.php";

require 'template/base-layout.php';
