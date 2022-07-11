<?php
require '../config.php';
require '../db/dao/ImageDaoMysql.php';

$imageDao = new ImageDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id');

if($id) {
    $imageDao->delete($id);
}
header("location: admin.php");
exit;