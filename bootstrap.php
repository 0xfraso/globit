<?php
//session_start();

define("PROFILE_PIC_DIR", "upload/profile/");
define("POST_PIC_DIR", "upload/post/");
define("SVG_DIR", "assets/svg/");
require_once 'database.php';
require_once 'functions.php';

sec_session_start();

$dbh = new DatabaseHelper("localhost", "root", "", "social", 3306);
if (!isset($_COOKIE['theme'])) {
    $_COOKIE['theme'] = 'dark';
};
