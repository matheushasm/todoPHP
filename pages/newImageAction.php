<?php
require '../config.php';
require '../db/dao/ImageDaoMysql.php';

$imageDao = new ImageDaoMysql($pdo);

$url = filter_input(INPUT_POST, 'url');

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