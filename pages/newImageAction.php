<?php
require_once '../config.php';
require_once '../db/dao/ImageDaoMysql.php';

$imageDao = new ImageDaoMysql($pdo);

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

if($url) {
    $i = new Image();
    $i->setUrl($url);

    $imageDao->add($i);

    header("location: admin.php");
    exit;
} 
header("location: newImage.php");
exit;
?>