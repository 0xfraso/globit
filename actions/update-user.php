<?php

require("../bootstrap.php");
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["username"]) && isset($_POST["full_name"]) && isset($_FILES["profile_picture"]) && isset($_POST["description"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $username = $_POST["username"];
    $full_name = $_POST["full_name"];
    $profile_picture = $_FILES["profile_picture"];
    $description = $_POST["description"];
    $random_salt = hash('sha512', uniqid(random_int(1, PHP_INT_MAX), true));
    $password = hash('sha512', $password . $random_salt);

    list($result, $msg) = uploadImage(PROFILE_PIC_DIR, $profile_picture);

    if ($result == 1) {
        $image = $msg;

        $success = $dbh->preparedQuery("UPDATE_USER_INFO", $username, $password, $random_salt, $full_name, $email, $image, $description, $_SESSION["user_id"]);
        var_dump($success);

        if ($success) {
            if (signin($email, $_POST["password"], $dbh) == true) {
                header("location: ../profile-settings.php?msg=Utente modificato con successo!");
            } else {
                header("location: ../profile-settings.php?error=Errore nella modifica dell'utente.");
            }
        }
    } else {
        header("location: ../profile-settings.php?error=" . $msg);
    }
};
