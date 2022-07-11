<?php
require '../config.php';
require '../db/dao/userDaoMysql.php';

$userDao = new userDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_INT);

if($id) {
    $userDao->delete($id);
}
header("location: admin.php");
exit;
?>