<?php
require_once 'bootstrap.php';

$templateParams['title'] = "Home";
$templateParams['main'] = "template/main/home.php";
//$templateParams['header'] = "template/header/home.php";
$templateParams['aside'] = "template/aside/home.php";
$templateParams['layout'] = "template/layout/main.php";

require 'template/base-layout.php';
