<?php
require_once '../config.php';
require_once '../db/dao/ImageDaoMysql.php';

$imageDao = new ImageDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id');

if($id) {
    $imageDao->delete($id);
}
header("location: admin.php");
exit;