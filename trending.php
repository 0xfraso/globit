<?php
require_once 'bootstrap.php';

$trending_tags = $dbh->preparedQuery("SELECT_TRENDING_TAGS", 10);
$templateParams['tags'] = $trending_tags;

$templateParams['title'] = "Profilo";
$templateParams['main'] = "template/main/trending.php";
//$templateParams['header'] = "template/header/home.php";
$templateParams['aside'] = "template/aside/trending.php";
$templateParams['layout'] = "template/layout/main.php";

require 'template/base-layout.php';
