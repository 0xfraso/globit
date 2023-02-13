<?php
require_once("bootstrap.php");

if (signin_check($dbh)) {

    $user = $dbh->preparedQuery("SELECT_USER_INFO", $_SESSION["user_id"])[0];

    $templateParams['user'] = $user;
    $templateParams['title'] = "Notifiche";
    $templateParams['main'] = "template/main/notifications.php";
    $templateParams['aside'] = "template/aside/profile.php";
    $templateParams['layout'] = "template/layout/main.php";

    require 'template/base-layout.php';
} else {
    echo "Non sei autorizzato ad accedere a questa pagina, per favore accedi.";
}
