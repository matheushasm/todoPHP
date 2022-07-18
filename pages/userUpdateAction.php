<?php
require_once '../config.php';
require_once '../db/dao/userDaoMysql.php';

$userDao = new UserDaoMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
$ip = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_STRING);
$user_key = filter_input(INPUT_POST, 'user_key', FILTER_SANITIZE_STRING);

if($id) {
    $user = new User();
    $user->setId($id);
    $user->setName($name);
    $user->setLocation($location);
    $user->setIp($ip);
    $user->setUser_key($user_key);

    $userDao->update($user);

    header("location: admin.php");
    exit;
} 

header("location: userUpdate.php");
exit;
?>