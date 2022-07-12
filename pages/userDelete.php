<?php
require_once '../config.php';
require_once '../db/dao/userDaoMysql.php';

$userDao = new userDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id');

if($id) {
    $userDao->delete($id);
}
header("location: admin.php");
exit;
?>