<?php
require("../bootstrap.php");
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (signin($email, $password, $dbh) == true) {
        header("location: ../index.php");
    } else {
        header("location: ../signin.php?error=Errore! Controllare email e password.");
    }
}
