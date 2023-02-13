<?php
require_once 'bootstrap.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    $id = $_SESSION["user_id"];
}

$user = $dbh->preparedQuery("SELECT_USER_INFO", $id)[0];

$templateParams['user'] = $user;
$templateParams['title'] = $user['full_name'] . ' - @' . $user["username"];
$templateParams['main'] = "template/main/profile.php";
$templateParams['aside'] = "template/aside/profile.php";
$templateParams['layout'] = "template/layout/inverted.php";

require 'template/base-layout.php';
